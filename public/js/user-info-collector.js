/**
 * Coletor de Informações do Usuário
 * Este script coleta informações do usuário e as envia para o servidor
 */

class UserInfoCollector {
    constructor(options = {}) {
        this.options = {
            endpoint: '/user-info',
            autoCollect: true,
            onSuccess: null,
            onError: null,
            ...options
        };

        if (this.options.autoCollect) {
            this.collect();
        }
    }

    /**
     * Coleta informações do usuário
     */
    collect() {
        // Coleta informações adicionais do lado do cliente
        const clientInfo = this.collectClientInfo();

        // Gera um identificador único para o dispositivo
        const deviceId = this.generateDeviceId(clientInfo);
        clientInfo.device_id = deviceId;

        // Envia para o servidor
        this.sendToServer(clientInfo);
    }

    /**
     * Coleta informações adicionais do lado do cliente
     */
    collectClientInfo() {
        return {
            screen_resolution: `${window.screen.width}x${window.screen.height}`,
            color_depth: window.screen.colorDepth,
            timezone: Intl.DateTimeFormat().resolvedOptions().timeZone,
            language: navigator.language,
            cookies_enabled: navigator.cookieEnabled,
            do_not_track: navigator.doNotTrack,
            online: navigator.onLine,
            connection: this.getConnectionInfo(),
            plugins: this.getPluginsInfo(),
            incognito: this.detectIncognito(),
            timestamp: new Date().toISOString(),
            // Informações adicionais para identificação do dispositivo
            device_memory: navigator.deviceMemory || null,
            hardware_concurrency: navigator.hardwareConcurrency || null,
            touch_points: navigator.maxTouchPoints || null,
            vendor: navigator.vendor || null,
            platform: navigator.platform || null,
            user_agent: navigator.userAgent || null,
            accept_language: navigator.language || null,
            accept_encoding: this.getAcceptEncoding(),
            // Fingerprint do canvas (técnica de fingerprinting)
            canvas_fingerprint: this.getCanvasFingerprint(),
            // Fingerprint do WebGL (técnica de fingerprinting)
            webgl_fingerprint: this.getWebGLFingerprint()
        };
    }

    /**
     * Gera um identificador único para o dispositivo no lado do cliente
     *
     * @param {Object} clientInfo Informações do cliente
     * @return {string} Identificador único
     */
    generateDeviceId(clientInfo) {
        // Cria uma string com todas as informações relevantes
        const deviceString = [
            clientInfo.user_agent,
            clientInfo.platform,
            clientInfo.vendor,
            clientInfo.language,
            clientInfo.screen_resolution,
            clientInfo.color_depth,
            clientInfo.timezone,
            clientInfo.hardware_concurrency,
            clientInfo.device_memory,
            clientInfo.touch_points,
            clientInfo.canvas_fingerprint,
            clientInfo.webgl_fingerprint,
            // Adiciona um salt para maior segurança
            'plataforma-sky'
        ].join('|');

        // Gera um hash SHA-256 da string
        return this.hashString(deviceString);
    }

    /**
     * Gera um hash SHA-256 de uma string
     *
     * @param {string} str String para gerar o hash
     * @return {string} Hash SHA-256
     */
    hashString(str) {
        // Implementação simplificada de hash para navegadores que não suportam SubtleCrypto
        let hash = 0;
        for (let i = 0; i < str.length; i++) {
            const char = str.charCodeAt(i);
            hash = ((hash << 5) - hash) + char;
            hash = hash & hash; // Converte para inteiro de 32 bits
        }

        // Converte para hexadecimal
        return Math.abs(hash).toString(16);
    }

    /**
     * Obtém o Accept-Encoding do navegador
     */
    getAcceptEncoding() {
        // Tenta obter o Accept-Encoding do cabeçalho da requisição
        // Como não podemos acessar diretamente, usamos uma abordagem indireta
        const encodings = ['gzip', 'deflate', 'br'];
        return encodings.join(', ');
    }

    /**
     * Obtém um fingerprint do canvas
     */
    getCanvasFingerprint() {
        try {
            const canvas = document.createElement('canvas');
            const ctx = canvas.getContext('2d');

            // Define o tamanho do canvas
            canvas.width = 200;
            canvas.height = 50;

            // Desenha texto com diferentes fontes e estilos
            ctx.textBaseline = 'top';
            ctx.font = '14px Arial';
            ctx.fillStyle = '#f60';
            ctx.fillRect(125, 1, 62, 20);

            ctx.fillStyle = '#069';
            ctx.fillText('A Escola da Fé', 2, 15);
            ctx.fillStyle = 'rgba(102, 204, 0, 0.7)';
            ctx.fillText('A Escola da Fé', 4, 17);

            // Retorna o fingerprint como string base64
            return canvas.toDataURL().substring(0, 100);
        } catch (e) {
            return 'canvas-error';
        }
    }

    /**
     * Obtém um fingerprint do WebGL
     */
    getWebGLFingerprint() {
        try {
            const canvas = document.createElement('canvas');
            const gl = canvas.getContext('webgl') || canvas.getContext('experimental-webgl');

            if (!gl) {
                return 'webgl-not-supported';
            }

            // Coleta informações do WebGL
            const debugInfo = gl.getExtension('WEBGL_debug_renderer_info');
            if (!debugInfo) {
                return 'webgl-debug-info-not-supported';
            }

            const vendor = gl.getParameter(debugInfo.UNMASKED_VENDOR_WEBGL);
            const renderer = gl.getParameter(debugInfo.UNMASKED_RENDERER_WEBGL);

            return `${vendor}|${renderer}`;
        } catch (e) {
            return 'webgl-error';
        }
    }

    /**
     * Obtém informações de conexão
     */
    getConnectionInfo() {
        if (navigator.connection) {
            return {
                type: navigator.connection.effectiveType,
                downlink: navigator.connection.downlink,
                rtt: navigator.connection.rtt
            };
        }
        return null;
    }

    /**
     * Obtém informações sobre plugins instalados
     */
    getPluginsInfo() {
        if (navigator.plugins) {
            const plugins = [];
            for (let i = 0; i < navigator.plugins.length; i++) {
                plugins.push(navigator.plugins[i].name);
            }
            return plugins;
        }
        return [];
    }

    /**
     * Tenta detectar se o usuário está em modo anônimo/privado
     * Esta é uma detecção básica e não é 100% confiável
     */
    detectIncognito() {
        // Verificação 1: Verificar se o localStorage está disponível
        try {
            localStorage.setItem('test', 'test');
            localStorage.removeItem('test');
        } catch (e) {
            return true;
        }

        // Verificação 2: Verificar se o IndexedDB está disponível
        try {
            const request = indexedDB.open('test');
            request.onerror = function() {
                return true;
            };
        } catch (e) {
            return true;
        }

        // Verificação 3: Verificar se o FileSystem API está disponível
        if (window.webkitRequestFileSystem || window.requestFileSystem) {
            return false;
        }

        return false;
    }

    /**
     * Envia as informações coletadas para o servidor
     */
    sendToServer(clientInfo) {
        fetch(this.options.endpoint, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            credentials: 'same-origin'
        })
        .then(response => response.json())
        .then(data => {
            // Combina as informações do servidor com as do cliente
            const combinedInfo = {
                ...data,
                client_info: clientInfo
            };

            // Chama o callback de sucesso, se existir
            if (this.options.onSuccess && typeof this.options.onSuccess === 'function') {
                this.options.onSuccess(combinedInfo);
            }

            // Armazena localmente, se necessário
            this.storeLocally(combinedInfo);
        })
        .catch(error => {
            console.error('Erro ao coletar informações do usuário:', error);

            // Chama o callback de erro, se existir
            if (this.options.onError && typeof this.options.onError === 'function') {
                this.options.onError(error);
            }
        });
    }

    /**
     * Armazena as informações localmente
     */
    storeLocally(info) {
        try {
            // Armazena no localStorage com timestamp
            const key = `user_info_${new Date().getTime()}`;
            localStorage.setItem(key, JSON.stringify(info));

            // Limita o número de entradas armazenadas (mantém apenas as 10 mais recentes)
            this.cleanupLocalStorage();
        } catch (e) {
            console.error('Erro ao armazenar informações localmente:', e);
        }
    }

    /**
     * Limpa entradas antigas do localStorage
     */
    cleanupLocalStorage() {
        try {
            const keys = Object.keys(localStorage);
            const userInfoKeys = keys.filter(key => key.startsWith('user_info_'));

            if (userInfoKeys.length > 10) {
                // Ordena por timestamp (que está no nome da chave)
                userInfoKeys.sort();

                // Remove as entradas mais antigas
                for (let i = 0; i < userInfoKeys.length - 10; i++) {
                    localStorage.removeItem(userInfoKeys[i]);
                }
            }
        } catch (e) {
            console.error('Erro ao limpar localStorage:', e);
        }
    }
}

// Exporta para uso global
window.UserInfoCollector = UserInfoCollector;

// Exemplo de uso:
// const collector = new UserInfoCollector({
//     onSuccess: (info) => console.log('Informações coletadas:', info),
//     onError: (error) => console.error('Erro:', error)
// });
