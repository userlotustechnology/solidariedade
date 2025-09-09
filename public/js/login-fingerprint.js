/**
 * Coletor de Fingerprint para Login
 * Este script coleta informações do usuário automaticamente após o login
 */

class LoginFingerprintCollector {
    constructor() {
        this.endpoint = '/fingerprint/record';
        this.collector = null;
        this.init();
    }

    /**
     * Inicializa o coletor
     */
    init() {
        console.log('🚀 Inicializando coletor de fingerprint...');
        
        // Se estamos na página de login, limpa o storage
        if (this.isLoginPage()) {
            console.log('🔓 Página de login detectada. Limpando storage...');
            this.clearFingerprintStorage();
        }
        
        // Verifica se o usuário está logado
        if (this.isUserLoggedIn()) {
            console.log('👤 Usuário logado detectado. Iniciando coleta...');
            this.startCollection();
        } else {
            console.log('❌ Usuário não logado. Coleta de fingerprint não iniciada.');
        }
    }

    /**
     * Verifica se estamos na página de login
     */
    isLoginPage() {
        return window.location.pathname === '/login' || 
               window.location.pathname.includes('login') ||
               document.querySelector('form[action*="login"]') !== null ||
               document.querySelector('input[name="email"]') !== null;
    }

    /**
     * Limpa o storage de fingerprint
     */
    clearFingerprintStorage() {
        try {
            // Remove todas as chaves relacionadas a fingerprint
            const keysToRemove = [];
            for (let i = 0; i < sessionStorage.length; i++) {
                const key = sessionStorage.key(i);
                if (key && key.includes('fingerprint_collected')) {
                    keysToRemove.push(key);
                }
            }
            
            keysToRemove.forEach(key => {
                sessionStorage.removeItem(key);
                console.log('🗑️ Removido do storage:', key);
            });
            
            console.log('✅ Storage de fingerprint limpo');
        } catch (e) {
            console.warn('⚠️ Erro ao limpar storage:', e);
        }
    }

    /**
     * Verifica se o usuário está logado
     */
    isUserLoggedIn() {
        // Verifica se existe um token CSRF (indicativo de que o usuário está logado)
        const csrfToken = document.querySelector('meta[name="csrf-token"]');
        return csrfToken !== null;
    }

    /**
     * Inicia a coleta de informações
     */
    startCollection() {
        // Verifica se já foi coletado nesta sessão
        if (this.hasAlreadyCollected()) {
            console.log('🔄 Fingerprint já foi coletado nesta sessão. Pulando...');
            return;
        }

        // Aguarda um pouco para garantir que a página carregou completamente
        setTimeout(() => {
            this.collectAndSend();
        }, 1000);
    }

    /**
     * Verifica se já foi coletado fingerprint nesta sessão
     */
    hasAlreadyCollected() {
        try {
            const fingerprintKey = 'fingerprint_collected_' + new Date().toDateString();
            return sessionStorage.getItem(fingerprintKey) === 'true';
        } catch (e) {
            console.warn('❌ Erro ao verificar se fingerprint já foi coletado:', e);
            return false;
        }
    }

    /**
     * Marca que o fingerprint foi coletado nesta sessão
     */
    markAsCollected() {
        try {
            const fingerprintKey = 'fingerprint_collected_' + new Date().toDateString();
            sessionStorage.setItem(fingerprintKey, 'true');
            console.log('✅ Fingerprint marcado como coletado para esta sessão');
        } catch (e) {
            console.warn('❌ Erro ao marcar fingerprint como coletado:', e);
        }
    }

    /**
     * Coleta e envia as informações
     */
    async collectAndSend() {
        try {
            // Coleta informações do cliente
            const clientInfo = this.collectClientInfo();
            
            // Gera device ID (agora é assíncrono)
            const deviceId = await this.generateDeviceId(clientInfo);
            clientInfo.device_id = deviceId;

            console.log('🆔 Device ID gerado:', deviceId);

            // Verifica se já existe um fingerprint para este device_id
            if (await this.checkExistingFingerprint(deviceId)) {
                console.log('🔄 Fingerprint já existe para este dispositivo. Pulando...');
                this.markAsCollected(); // Marca como coletado para evitar verificações futuras
                return;
            }

            // Envia para o servidor
            this.sendToServer(clientInfo);

        } catch (error) {
            console.error('❌ Erro ao coletar fingerprint:', error);
        }
    }

    /**
     * Verifica se já existe um fingerprint para este device_id
     */
    async checkExistingFingerprint(deviceId) {
        try {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            
            const response = await fetch('/fingerprint/check-existing', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({ device_id: deviceId })
            });

            if (response.ok) {
                const data = await response.json();
                return data.exists || false;
            }
            
            return false;
        } catch (error) {
            console.warn('⚠️ Erro ao verificar fingerprint existente:', error);
            return false;
        }
    }

    /**
     * Coleta informações do cliente
     */
    collectClientInfo() {
        const incognito = this.detectIncognito();
        
        const clientInfo = {
            screen_resolution: `${window.screen.width}x${window.screen.height}`,
            color_depth: window.screen.colorDepth,
            timezone: Intl.DateTimeFormat().resolvedOptions().timeZone,
            language: navigator.language,
            cookies_enabled: navigator.cookieEnabled,
            do_not_track: navigator.doNotTrack,
            online: navigator.onLine,
            connection: this.getConnectionInfo(),
            plugins: this.getPluginsInfo(),
            incognito: incognito,
            timestamp: new Date().toISOString(),
            device_memory: navigator.deviceMemory || null,
            hardware_concurrency: navigator.hardwareConcurrency || null,
            touch_points: navigator.maxTouchPoints || null,
            vendor: navigator.vendor || null,
            platform: navigator.platform || null,
            user_agent: navigator.userAgent || null,
            accept_language: navigator.language || null,
            accept_encoding: this.getAcceptEncoding(),
            webgl_fingerprint: this.getWebGLFingerprint()
        };
        
        // Log para debug
        console.log('📱 Informações coletadas do cliente:');
        console.log('  - Modo incógnito:', incognito);
        console.log('  - Navegador:', navigator.userAgent);
        console.log('  - Plataforma:', navigator.platform);
        console.log('  - Resolução:', clientInfo.screen_resolution);
        
        return clientInfo;
    }

    /**
     * Gera um identificador único para o dispositivo
     * Usa o mesmo algoritmo do servidor para garantir consistência
     */
    async generateDeviceId(clientInfo) {
        // Características principais do dispositivo (mesmo que no servidor)
        const characteristics = {
            user_agent: clientInfo.user_agent,
            screen_resolution: clientInfo.screen_resolution,
            color_depth: clientInfo.color_depth,
            timezone: clientInfo.timezone,
            language: clientInfo.language,
            device_memory: clientInfo.device_memory,
            hardware_concurrency: clientInfo.hardware_concurrency,
            touch_points: clientInfo.touch_points,
            vendor: clientInfo.vendor,
            platform: clientInfo.platform,
            webgl_fingerprint: clientInfo.webgl_fingerprint,
            connection_type: clientInfo.connection.type,
            connection_downlink: clientInfo.connection.downlink,
            connection_rtt: clientInfo.connection.rtt
        };

        // Remove valores vazios ou nulos
        const filteredCharacteristics = {};
        for (const [key, value] of Object.entries(characteristics)) {
            if (value !== null && value !== undefined && value !== '') {
                filteredCharacteristics[key] = value;
            }
        }

        // Ordena as características para garantir consistência
        const sortedKeys = Object.keys(filteredCharacteristics).sort();
        const fingerprintString = sortedKeys.map(key => filteredCharacteristics[key]).join('|');

        // Gera hash SHA-256
        const hash = await this.hashString(fingerprintString);
        
        // Retorna apenas os primeiros 32 caracteres (mesmo que no servidor)
        return hash.substring(0, 32);
    }

    /**
     * Gera um hash SHA-256 de uma string
     */
    async hashString(str) {
        const encoder = new TextEncoder();
        const data = encoder.encode(str);
        const hashBuffer = await crypto.subtle.digest('SHA-256', data);
        const hashArray = Array.from(new Uint8Array(hashBuffer));
        return hashArray.map(b => b.toString(16).padStart(2, '0')).join('');
    }

    /**
     * Obtém informações de aceitação de encoding
     */
    getAcceptEncoding() {
        return 'gzip, deflate, br';
    }

    /**
     * Gera fingerprint do WebGL
     */
    getWebGLFingerprint() {
        try {
            const canvas = document.createElement('canvas');
            const gl = canvas.getContext('webgl') || canvas.getContext('experimental-webgl');
            
            if (!gl) return null;
            
            const debugInfo = gl.getExtension('WEBGL_debug_renderer_info');
            if (debugInfo) {
                return gl.getParameter(debugInfo.UNMASKED_RENDERER_WEBGL);
            }
            
            return gl.getParameter(gl.RENDERER);
        } catch (e) {
            return null;
        }
    }

    /**
     * Obtém informações de conexão
     */
    getConnectionInfo() {
        if ('connection' in navigator) {
            const connection = navigator.connection;
            return {
                type: connection.effectiveType || connection.type || null,
                downlink: connection.downlink || null,
                rtt: connection.rtt || null
            };
        }
        return {};
    }

    /**
     * Obtém informações dos plugins
     */
    getPluginsInfo() {
        const plugins = [];
        if (navigator.plugins) {
            for (let i = 0; i < navigator.plugins.length; i++) {
                plugins.push(navigator.plugins[i].name);
            }
        }
        return plugins;
    }

    /**
     * Detecta modo incógnito de forma mais confiável
     */
    detectIncognito() {
        try {
            const testKey = '__incognito_test__';
            let localStorageWorks = false;
            let sessionStorageWorks = false;
            
            // Teste localStorage
            try {
                localStorage.setItem(testKey, '1');
                localStorageWorks = localStorage.getItem(testKey) === '1';
                localStorage.removeItem(testKey);
            } catch (e) {
                localStorageWorks = false;
            }
            
            // Teste sessionStorage
            try {
                sessionStorage.setItem(testKey, '1');
                sessionStorageWorks = sessionStorage.getItem(testKey) === '1';
                sessionStorage.removeItem(testKey);
            } catch (e) {
                sessionStorageWorks = false;
            }
            
            // Teste de quota (método mais confiável para detectar incógnito)
            let quotaTest = false;
            try {
                // Tenta escrever uma string grande para testar a quota
                const testString = 'a'.repeat(1024 * 1024); // 1MB
                localStorage.setItem('quota_test', testString);
                localStorage.removeItem('quota_test');
                quotaTest = true;
            } catch (e) {
                if (e.name === 'QuotaExceededError') {
                    quotaTest = false;
                } else {
                    quotaTest = true; // Se não é erro de quota, provavelmente funciona
                }
            }
            
            // Lógica de detecção melhorada
            let isIncognito = false;
            
            // Se localStorage não funciona, é incógnito
            if (!localStorageWorks) {
                isIncognito = true;
            }
            // Se sessionStorage não funciona, é incógnito
            else if (!sessionStorageWorks) {
                isIncognito = true;
            }
            // Se a quota está muito limitada, pode ser incógnito
            else if (!quotaTest) {
                isIncognito = true;
            }
            
            // Logs para debug
            console.log('🔍 Detecção de modo incógnito:');
            console.log('  - localStorage funciona:', localStorageWorks);
            console.log('  - sessionStorage funciona:', sessionStorageWorks);
            console.log('  - Teste de quota passa:', quotaTest);
            console.log('  - Modo incógnito detectado:', isIncognito);
            
            return isIncognito;
            
        } catch (e) {
            console.warn('❌ Erro ao detectar modo incógnito:', e);
            return true; // Em caso de erro, assume incógnito
        }
    }

    /**
     * Envia as informações para o servidor
     */
    async sendToServer(clientInfo) {
        try {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            
            const response = await fetch(this.endpoint, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify(clientInfo)
            });

            if (response.ok) {
                const data = await response.json();
                console.log('✅ Fingerprint registrado com sucesso:', data);
                
                // Marca como coletado apenas após sucesso
                this.markAsCollected();
            } else {
                console.error('❌ Erro ao registrar fingerprint:', response.status);
            }
        } catch (error) {
            console.error('❌ Erro ao enviar fingerprint:', error);
        }
    }
}

// Inicializa o coletor quando o DOM estiver pronto
document.addEventListener('DOMContentLoaded', function() {
    new LoginFingerprintCollector();
}); 