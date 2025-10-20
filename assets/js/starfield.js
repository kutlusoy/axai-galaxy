/**
 * AxAI Galaxy Starfield Animation - Complete Version
 * @package AxAI_Galaxy
 * @since 1.0
 */

(function() {
    'use strict';
    
    if (typeof THREE === 'undefined') {
        console.error('Three.js is not loaded');
        return;
    }
    
    const CONFIG = window.axaiConfig || {};
    
    // Standard-Galaxie-Typen als Fallback - VERBESSERTE KONFIGURATION
    const DEFAULT_GALAXY_TYPES = [
        {
            name: 'Milky Way Style',
            arms: 4,
            armPoints: 2500,
            tightness: 2.5,
            coreColor: { r: 1.0, g: 0.95, b: 0.85 },
            innerColor: { r: 0.95, g: 0.85, b: 0.7 },
            outerColor: { r: 0.5, g: 0.6, b: 0.85 },
            dustColor: { r: 0.4, g: 0.35, b: 0.3 },
            hasBar: true,
            diskThickness: 0.25,
            armWidth: 0.08,
            armDensity: 6.5
        },
        {
            name: 'Andromeda Style',
            arms: 2,
            armPoints: 5250,
            tightness: 5.3,
            coreColor: { r: 1.0, g: 0.92, b: 0.75 },
            innerColor: { r: 0.85, g: 0.75, b: 0.95 },
            outerColor: { r: 0.4, g: 0.5, b: 0.9 },
            dustColor: { r: 0.5, g: 0.3, b: 0.4 },
            hasBar: false,
            diskThickness: 0.32,
            armWidth: 0.06,
            armDensity: 3.0
        },
        {
            name: 'Whirlpool Style',
            arms: 2,
            armPoints: 2600,
            tightness: 2.5,
            coreColor: { r: 0.8, g: 0.2, b: 0.5 },
            innerColor: { r: 0.95, g: 0.65, b: 0.8 },
            outerColor: { r: 0.6, g: 0.4, b: 0.85 },
            dustColor: { r: 0.2, g: 0.4, b: 0.8 },
            hasBar: false,
            diskThickness: 0.3,
            armWidth: 0.05,
            armDensity: 3.2
        },
        {
            name: 'Pinwheel Style',
            arms: 5,
            armPoints: 1750,
            tightness: 7.25,
            coreColor: { r: 0.95, g: 1.0, b: 0.9 },
            innerColor: { r: 1.0, g: 0.1, b: 0.1 },
            outerColor: { r: 0.4, g: 0.65, b: 0.95 },
            dustColor: { r: 0.35, g: 0.5, b: 0.45 },
            hasBar: false,
            diskThickness: 0.33,
            armWidth: 0.07,
            armDensity: 2.8
        },
        {
            name: 'Triangulum Style',
            arms: 3,
            armPoints: 1300,
            tightness: 9.35,
            coreColor: { r: 0.2, g: 0.4, b: 0.8 },
            innerColor: { r: 0.8, g: 0.7, b: 0.95 },
            outerColor: { r: 0.5, g: 0.4, b: 0.85 },
            dustColor: { r: 0.45, g: 0.3, b: 0.5 },
            hasBar: false,
            diskThickness: 0.24,
            armWidth: 0.065,
            armDensity: 2.6
        },
        {
            name: 'Sombrero Style',
            arms: 2,
            armPoints: 2500,
            tightness: 5.6,
            coreColor: { r: 0.5, g: 0.2, b: 0.8 },
            innerColor: { r: 0.9, g: 0.65, b: 0.45 },
            outerColor: { r: 0.6, g: 0.4, b: 0.3 },
            dustColor: { r: 0.35, g: 0.2, b: 0.15 },
            hasBar: false,
            diskThickness: 0.28,
            armWidth: 0.04,
            armDensity: 3.5
        }
    ];
    
    const DEFAULT_CONFIG = {
        idleSpeed: 0.5,
        warpSpeed: 250,
        starCount: 1000,
        starMinRadius: 100,
        starMaxRadius: 500,
        starDepthRange: 4000,
        starBaseOpacity: 0.9,
        starBrightness: 2.5,
        starWarpBrightness: 0.5,
        starMinSize: 0.5,
        starMaxSize: 1.0,
        starCloseCount: 50,
        nebulaCount: 80,
        nebulaMinRadius: 300,
        nebulaMaxRadius: 900,
        nebulaBaseOpacity: 0.3,
        nebulaBaseSize: 1200,
        galaxiesEnabled: true,
        galaxyCount: 5,
        galaxyMinRadius: 600,
        galaxyMaxRadius: 800,
        galaxySpeed: 0.02,
        galaxyBaseSize: 800,
        galaxyMaxSize: 1200,
        galaxyOpacity: 0.3,
        galaxyRotationSpeed: 0.0001,
        galaxyCoreSize: 200,
        galaxySpawnChance: 0.6,
        cameraFOV: 85,
        parallaxIntensity: 10,
        warpTriggerClass: 'hero-button',
        colors: {
            nebula: {
                purple: { r: 0.5, g: 0.2, b: 0.8 },
                blue: { r: 0.2, g: 0.4, b: 0.8 },
                pink: { r: 0.8, g: 0.2, b: 0.5 },
                warpViolet: { r: 0.6, g: 0.1, b: 0.9 },
                warpRed: { r: 1.0, g: 0.1, b: 0.1 }
            },
            star: {
                purple: { r: 0.65, g: 0.3, b: 1.0 },
                pink: { r: 1.0, g: 0.3, b: 0.6 },
                blue: { r: 0.3, g: 0.6, b: 1.0 },
                white: { r: 1.0, g: 1.0, b: 1.0 }
            }
        },
        galaxyTypes: DEFAULT_GALAXY_TYPES
    };
    
    // Konfiguration sicher zusammenführen
    const config = {};
    for (const key in DEFAULT_CONFIG) {
        if (CONFIG.hasOwnProperty(key)) {
            const defaultValue = DEFAULT_CONFIG[key];
            const configValue = CONFIG[key];
            
            if (typeof defaultValue === 'number') {
                config[key] = Number(configValue) || defaultValue;
            } else if (typeof defaultValue === 'boolean') {
                config[key] = Boolean(configValue);
            } else if (key === 'galaxyTypes' && (!configValue || configValue.length === 0)) {
                config[key] = DEFAULT_GALAXY_TYPES;
            } else {
                config[key] = configValue !== undefined ? configValue : defaultValue;
            }
        } else {
            config[key] = DEFAULT_CONFIG[key];
        }
    }
    
    console.log('Initializing AxAI Starfield with config:', config);
    
    class AxAIStarfield {
        constructor(canvas) {
            this.canvas = canvas;
            this.buttonClass = config.warpTriggerClass || 'hero-button';
            this.buttons = document.querySelectorAll('.' + this.buttonClass);
            
            this.idleSpeed = config.idleSpeed;
            this.warpSpeed = config.warpSpeed;
            this.currentSpeed = this.idleSpeed;
            this.targetSpeed = this.idleSpeed;
            
            this.mousePos = { x: 0, y: 0 };
            this.isPaused = false;
            this.scrollY = 0;
            this.time = 0;
            this.isInWarp = false;
            
            this.parallaxIntensity = config.parallaxIntensity;
            this.perspectiveEnabled = true;
            
            this.nebulaTrails = [];
            this.galaxies = [];
            this.cameraOffset = { x: 0, y: 0 };
            this.buttonPositions = [];
            
            this.init();
        }
        
        init() {
            try {
                this.setupScene();
                this.createMorphingStars();
                this.createNebula();
                if (config.galaxiesEnabled && config.galaxyTypes && config.galaxyTypes.length > 0) {
                    this.galaxyGroup = new THREE.Group();
                    this.scene.add(this.galaxyGroup);
                    this.spawnInitialGalaxies();
                }
                this.setupEventListeners();
                this.updateButtonPosition();
                this.animate();
                console.log('AxAI Starfield initialized successfully');
            } catch (error) {
                console.error('Error initializing starfield:', error);
            }
        }
        
        spawnInitialGalaxies() {
            if (!config.galaxiesEnabled || !config.galaxyTypes || config.galaxyTypes.length === 0) {
                console.warn('Galaxies disabled or no galaxy types available');
                return;
            }
            
            const initialCount = Math.min(Math.floor(config.galaxyCount / 2), config.galaxyTypes.length);
            for (let i = 0; i < initialCount; i++) {
                const galaxy = this.createGalaxy();
                if (galaxy) {
                    galaxy.userData.fadeIn = 1;
                    this.galaxyGroup.add(galaxy);
                    this.galaxies.push(galaxy);
                }
            }
        }
        
        setupScene() {
            this.scene = new THREE.Scene();
            this.scene.fog = new THREE.FogExp2(0x0a0e1a, 0.0002);
            
            this.camera = new THREE.PerspectiveCamera(
                config.cameraFOV,
                window.innerWidth / window.innerHeight,
                0.1,
                5000
            );
            this.camera.position.z = 1;
            
            this.renderer = new THREE.WebGLRenderer({
                canvas: this.canvas,
                antialias: true,
                alpha: false,
                powerPreference: "high-performance"
            });
            this.renderer.setSize(window.innerWidth, window.innerHeight);
            this.renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
            this.renderer.setClearColor(0x0a0e1a, 1);
        }
        
        createMorphingStars() {
            this.starLines = new THREE.Group();
            this.starPoints = new THREE.Group();
            this.starData = [];
            this.starPointData = [];
            const lineCount = Math.min(config.starCount, 5000);
            
            for (let i = 0; i < lineCount; i++) {
                const angle = Math.random() * Math.PI * 2;
                const radius = Math.random() * (config.starMaxRadius - config.starMinRadius) + config.starMinRadius;
                const z = (Math.random() * config.starDepthRange) - (config.starDepthRange / 2);
                
                const x = Math.cos(angle) * radius;
                const y = Math.sin(angle) * radius;
                
                const colorType = Math.random();
                let color;
                if (colorType < 0.25) {
                    color = new THREE.Color(config.colors.star.purple.r, config.colors.star.purple.g, config.colors.star.purple.b);
                } else if (colorType < 0.5) {
                    color = new THREE.Color(config.colors.star.pink.r, config.colors.star.pink.g, config.colors.star.pink.b);
                } else if (colorType < 0.75) {
                    color = new THREE.Color(config.colors.star.blue.r, config.colors.star.blue.g, config.colors.star.blue.b);
                } else {
                    color = new THREE.Color(config.colors.star.white.r, config.colors.star.white.g, config.colors.star.white.b);
                }
                
                const geometry = new THREE.BufferGeometry();
                const positions = new Float32Array([x, y, z, x, y, z - 3]);
                geometry.setAttribute('position', new THREE.BufferAttribute(positions, 3));
                
                const material = new THREE.LineBasicMaterial({
                    color: color,
                    transparent: true,
                    opacity: 0,
                    blending: THREE.AdditiveBlending,
                    linewidth: 1
                });
                
                const line = new THREE.Line(geometry, material);
                this.starLines.add(line);
                
                this.starData.push({
                    line: line,
                    baseX: x,
                    baseY: y,
                    baseZ: z,
                    angle: angle,
                    radius: radius,
                    velocity: Math.random() * 0.5 + 0.75,
                    baseColor: color.clone(),
                    initialZ: z
                });
            }
            
            const pointGeometry = new THREE.BufferGeometry();
            const pointPositions = new Float32Array(lineCount * 3);
            const pointColors = new Float32Array(lineCount * 3);
            const pointSizes = new Float32Array(lineCount);
            
            for (let i = 0; i < lineCount; i++) {
                const starData = this.starData[i];
                pointPositions[i * 3] = starData.baseX;
                pointPositions[i * 3 + 1] = starData.baseY;
                pointPositions[i * 3 + 2] = starData.baseZ;
                
                pointColors[i * 3] = starData.baseColor.r;
                pointColors[i * 3 + 1] = starData.baseColor.g;
                pointColors[i * 3 + 2] = starData.baseColor.b;
                
                const depth = Math.abs(starData.baseZ);
                const sizeScale = 1 - (depth / (config.starDepthRange / 2));
                pointSizes[i] = config.starMinSize + (config.starMaxSize - config.starMinSize) * Math.max(0, Math.min(1, sizeScale));
            }
            
            pointGeometry.setAttribute('position', new THREE.BufferAttribute(pointPositions, 3));
            pointGeometry.setAttribute('color', new THREE.BufferAttribute(pointColors, 3));
            pointGeometry.setAttribute('size', new THREE.BufferAttribute(pointSizes, 1));
            
            const pointMaterial = new THREE.PointsMaterial({
                size: 4,
                vertexColors: true,
                transparent: true,
                opacity: 1,
                blending: THREE.AdditiveBlending,
                depthTest: false,
                depthWrite: false,
                sizeAttenuation: true,
                map: this.createStarTexture()
            });
            
            this.starPointsMesh = new THREE.Points(pointGeometry, pointMaterial);
            this.starPoints.add(this.starPointsMesh);
            
            for (let i = 0; i < config.starCloseCount; i++) {
                const angle = Math.random() * Math.PI * 2;
                const radius = Math.random() * 50 + 10;
                const z = Math.random() * 100 - 50;
                
                const x = Math.cos(angle) * radius;
                const y = Math.sin(angle) * radius;
                
                const colorType = Math.random();
                let color;
                if (colorType < 0.25) {
                    color = new THREE.Color(config.colors.star.purple.r, config.colors.star.purple.g, config.colors.star.purple.b);
                } else if (colorType < 0.5) {
                    color = new THREE.Color(config.colors.star.pink.r, config.colors.star.pink.g, config.colors.star.pink.b);
                } else if (colorType < 0.75) {
                    color = new THREE.Color(config.colors.star.blue.r, config.colors.star.blue.g, config.colors.star.blue.b);
                } else {
                    color = new THREE.Color(config.colors.star.white.r, config.colors.star.white.g, config.colors.star.white.b);
                }
                
                const closeGeometry = new THREE.BufferGeometry();
                const closePositions = new Float32Array([x, y, z]);
                const closeColors = new Float32Array([color.r, color.g, color.b]);
                
                closeGeometry.setAttribute('position', new THREE.BufferAttribute(closePositions, 3));
                closeGeometry.setAttribute('color', new THREE.BufferAttribute(closeColors, 3));
                
                const closeMaterial = new THREE.PointsMaterial({
                    size: config.starMaxSize * 1.5,
                    vertexColors: true,
                    transparent: true,
                    opacity: 1,
                    blending: THREE.AdditiveBlending,
                    depthTest: false,
                    depthWrite: false,
                    sizeAttenuation: true,
                    map: this.createStarTexture()
                });
                
                const closePoint = new THREE.Points(closeGeometry, closeMaterial);
                this.starPoints.add(closePoint);
                
                this.starPointData.push({
                    mesh: closePoint,
                    baseX: x,
                    baseY: y,
                    baseZ: z,
                    angle: angle,
                    radius: radius,
                    velocity: Math.random() * 0.3 + 0.2,
                    baseColor: color.clone(),
                    isClose: true
                });
            }
            
            this.scene.add(this.starLines);
            this.scene.add(this.starPoints);
        }
        
        createStarTexture() {
            const canvas = document.createElement('canvas');
            canvas.width = 128;
            canvas.height = 128;
            const ctx = canvas.getContext('2d');
            
            ctx.clearRect(0, 0, 128, 128);
            
            const outerGlow = ctx.createRadialGradient(64, 64, 0, 64, 64, 64);
            outerGlow.addColorStop(0, 'rgba(255, 255, 255, 1)');
            outerGlow.addColorStop(0.1, 'rgba(255, 255, 255, 0.9)');
            outerGlow.addColorStop(0.2, 'rgba(255, 255, 255, 0.6)');
            outerGlow.addColorStop(0.4, 'rgba(255, 255, 255, 0.3)');
            outerGlow.addColorStop(0.6, 'rgba(255, 255, 255, 0.1)');
            outerGlow.addColorStop(0.8, 'rgba(255, 255, 255, 0.02)');
            outerGlow.addColorStop(1, 'rgba(255, 255, 255, 0)');
            
            ctx.fillStyle = outerGlow;
            ctx.fillRect(0, 0, 128, 128);
            
            const core = ctx.createRadialGradient(64, 64, 0, 64, 64, 20);
            core.addColorStop(0, 'rgba(255, 255, 255, 1)');
            core.addColorStop(0.3, 'rgba(255, 255, 255, 1)');
            core.addColorStop(0.6, 'rgba(255, 255, 255, 0.8)');
            core.addColorStop(1, 'rgba(255, 255, 255, 0)');
            
            ctx.fillStyle = core;
            ctx.fillRect(0, 0, 128, 128);
            
            const texture = new THREE.CanvasTexture(canvas);
            texture.needsUpdate = true;
            return texture;
        }
        
        createGalaxyTexture() {
            const canvas = document.createElement('canvas');
            canvas.width = 512;
            canvas.height = 512;
            const ctx = canvas.getContext('2d');
            
            ctx.clearRect(0, 0, 512, 512);
            
            const gradient = ctx.createRadialGradient(256, 256, 0, 256, 256, 256);
            gradient.addColorStop(0, 'rgba(255, 255, 255, 0.8)');
            gradient.addColorStop(0.15, 'rgba(255, 255, 255, 0.5)');
            gradient.addColorStop(0.4, 'rgba(255, 255, 255, 0.2)');
            gradient.addColorStop(0.7, 'rgba(255, 255, 255, 0.05)');
            gradient.addColorStop(1, 'rgba(255, 255, 255, 0)');
            
            ctx.fillStyle = gradient;
            ctx.fillRect(0, 0, 512, 512);
            
            const texture = new THREE.CanvasTexture(canvas);
            texture.needsUpdate = true;
            return texture;
        }
        
        createGalaxy() {
            if (!config.galaxyTypes || config.galaxyTypes.length === 0) {
                console.warn('No galaxy types available, skipping galaxy creation');
                return null;
            }
            
            const galaxy = new THREE.Group();
            const galaxyType = config.galaxyTypes[Math.floor(Math.random() * config.galaxyTypes.length)];
            
            if (!galaxyType || typeof galaxyType.arms === 'undefined') {
                console.warn('Invalid galaxy type configuration', galaxyType);
                return null;
            }
            
            const angle = Math.random() * Math.PI * 2;
            const radius = Math.random() * 1200 + 600;
            const z = (Math.random() * config.starDepthRange * 1.5) - (config.starDepthRange * 1.5 / 2);
            
            const x = Math.cos(angle) * radius;
            const y = Math.sin(angle) * radius;
            
            galaxy.position.set(x, y, z);
            
            const scale = config.galaxyBaseSize * 0.6 + Math.random() * (config.galaxyMaxSize * 0.5 - config.galaxyBaseSize * 0.6);
            galaxy.scale.set(scale, scale, scale);
            
            const tilt = (Math.random() - 0.5) * Math.PI * 0.4;
            galaxy.rotation.x = tilt;
            galaxy.rotation.y = Math.random() * Math.PI * 2;
            
            // NEBEL-GLOW vom Zentrum ausgehend
            const glowGeometry = new THREE.BufferGeometry();
            const glowCount = 500;
            const glowPositions = new Float32Array(glowCount * 3);
            const glowColors = new Float32Array(glowCount * 3);
            const glowSizes = new Float32Array(glowCount);
            
            for (let i = 0; i < glowCount; i++) {
                const r = Math.pow(Math.random(), 0.4) * 1.2;
                const theta = Math.random() * Math.PI * 2;
                const phi = Math.acos(2 * Math.random() - 1);
                
                glowPositions[i * 3] = r * Math.sin(phi) * Math.cos(theta);
                glowPositions[i * 3 + 1] = r * Math.sin(phi) * Math.sin(theta);
                glowPositions[i * 3 + 2] = r * Math.cos(phi) * 0.15;
                
                const fadeOut = 1 - (r / 1.2);
                const glowBrightness = fadeOut * 0.6;
                
                const glowColor = {
                    r: galaxyType.coreColor.r * 0.4 + galaxyType.innerColor.r * 0.6,
                    g: galaxyType.coreColor.g * 0.4 + galaxyType.innerColor.g * 0.6,
                    b: galaxyType.coreColor.b * 0.4 + galaxyType.innerColor.b * 0.6
                };
                
                glowColors[i * 3] = glowColor.r * glowBrightness;
                glowColors[i * 3 + 1] = glowColor.g * glowBrightness;
                glowColors[i * 3 + 2] = glowColor.b * glowBrightness;
                
                glowSizes[i] = 40 * fadeOut * (0.5 + Math.random() * 0.5);
            }
            
            glowGeometry.setAttribute('position', new THREE.BufferAttribute(glowPositions, 3));
            glowGeometry.setAttribute('color', new THREE.BufferAttribute(glowColors, 3));
            glowGeometry.setAttribute('size', new THREE.BufferAttribute(glowSizes, 1));
            
            const glowMaterial = new THREE.PointsMaterial({
                size: 50,
                vertexColors: true,
                transparent: true,
                opacity: config.galaxyOpacity * 0.95,
                blending: THREE.AdditiveBlending,
                depthTest: true,
                depthWrite: false,
                sizeAttenuation: true,
                map: this.createGalaxyTexture()
            });
            
            const glowMesh = new THREE.Points(glowGeometry, glowMaterial);
            glowMesh.userData = { baseOpacity: config.galaxyOpacity * 0.95 };
            galaxy.add(glowMesh);
            
            const arms = galaxyType.arms;
            const pointsPerArm = galaxyType.armPoints;
            const tightness = galaxyType.tightness;
            const diskThickness = galaxyType.diskThickness;
            const armWidth = galaxyType.armWidth;
            const armDensity = galaxyType.armDensity;
            
            if (galaxyType.hasBar) {
                const barGeometry = new THREE.BufferGeometry();
                const barPoints = 180;
                const barPositions = new Float32Array(barPoints * 3);
                const barColors = new Float32Array(barPoints * 3);
                const barSizes = new Float32Array(barPoints);
                
                for (let i = 0; i < barPoints; i++) {
                    const t = (i / barPoints) - 0.5;
                    const barLength = 0.65;
                    
                    barPositions[i * 3] = t * barLength + (Math.random() - 0.5) * 0.025;
                    barPositions[i * 3 + 1] = (Math.random() - 0.5) * 0.035;
                    barPositions[i * 3 + 2] = (Math.random() - 0.5) * diskThickness * 0.8;
                    
                    const distFromCenter = Math.abs(t) * 2;
                    const color = {
                        r: galaxyType.coreColor.r + (galaxyType.innerColor.r - galaxyType.coreColor.r) * distFromCenter,
                        g: galaxyType.coreColor.g + (galaxyType.innerColor.g - galaxyType.coreColor.g) * distFromCenter,
                        b: galaxyType.coreColor.b + (galaxyType.innerColor.b - galaxyType.coreColor.b) * distFromCenter
                    };
                    
                    barColors[i * 3] = color.r;
                    barColors[i * 3 + 1] = color.g;
                    barColors[i * 3 + 2] = color.b;
                    
                    barSizes[i] = 18 * (1 - distFromCenter * 0.3);
                }
                
                barGeometry.setAttribute('position', new THREE.BufferAttribute(barPositions, 3));
                barGeometry.setAttribute('color', new THREE.BufferAttribute(barColors, 3));
                barGeometry.setAttribute('size', new THREE.BufferAttribute(barSizes, 1));
                
                const barMaterial = new THREE.PointsMaterial({
                    size: 14,
                    vertexColors: true,
                    transparent: true,
                    opacity: config.galaxyOpacity * 1.8,
                    blending: THREE.AdditiveBlending,
                    depthTest: true,
                    depthWrite: false,
                    sizeAttenuation: true,
                    map: this.createGalaxyTexture()
                });
                
                const barMesh = new THREE.Points(barGeometry, barMaterial);
                barMesh.userData = { baseOpacity: config.galaxyOpacity * 0.8 };
                galaxy.add(barMesh);
            }
            
            for (let arm = 0; arm < arms; arm++) {
                const armAngleOffset = (arm / arms) * Math.PI * 2;
                
                const armGeometry = new THREE.BufferGeometry();
                const armPositions = new Float32Array(pointsPerArm * 3);
                const armColors = new Float32Array(pointsPerArm * 3);
                const armSizes = new Float32Array(pointsPerArm);
                
                let actualPointCount = 0;
                
                for (let i = 0; i < pointsPerArm; i++) {
                    const t = i / pointsPerArm;
                    
                    let densityFalloff;
                    if (t < 0.5) {
                        densityFalloff = 1.0 - (t / 0.5) * 0.8;
                    } else {
                        densityFalloff = 0.2 - ((t - 0.5) / 0.5) * 0.2;
                    }
                    
                    const spawnChance = densityFalloff;
                    
                    if (Math.random() > spawnChance) {
                        continue;
                    }
                    
                    const spiralAngle = armAngleOffset + t * Math.PI * (2.5 + tightness * 8);
                    const r = (galaxyType.hasBar ? 0.32 : 0.04) + Math.pow(t, 0.9) * 1.2;
                    
                    const armCenterX = Math.cos(spiralAngle) * r;
                    const armCenterY = Math.sin(spiralAngle) * r;
                    
                    let armWidthFactor;
                    if (t < 0.5) {
                        armWidthFactor = 1.0 - (t / 0.5) * 0.7;
                    } else {
                        armWidthFactor = 0.3 - ((t - 0.5) / 0.5) * 0.3;
                    }
                    const currentArmWidth = armWidth * armWidthFactor;
                    
                    const perpAngle = spiralAngle + Math.PI / 2;
                    const gaussianOffset = (Math.random() + Math.random() + Math.random() + Math.random() - 2) / 2;
                    const crossArmOffset = gaussianOffset * currentArmWidth * (1 + t * 0.5);
                    
                    const radialScatter = (Math.random() - 0.5) * currentArmWidth * 0.3 * (1 + t * 0.3);
                    
                    const px = armCenterX + Math.cos(perpAngle) * crossArmOffset + Math.cos(spiralAngle) * radialScatter;
                    const py = armCenterY + Math.sin(perpAngle) * crossArmOffset + Math.sin(spiralAngle) * radialScatter;
                    
                    let heightFactor;
                    if (t < 0.5) {
                        heightFactor = 1.0 - (t / 0.5) * 0.7;
                    } else {
                        heightFactor = 0.3 - ((t - 0.5) / 0.5) * 0.3;
                    }
                    const currentDiskThickness = diskThickness * heightFactor;
                    
                    const verticalFalloff = Math.pow(t, 2);
                    const pz = (Math.random() - 0.5) * currentDiskThickness * (1 + verticalFalloff * 0.3);
                    
                    armPositions[actualPointCount * 3] = px;
                    armPositions[actualPointCount * 3 + 1] = py;
                    armPositions[actualPointCount * 3 + 2] = pz;
                    
                    let color;
                    if (t < 0.12) {
                        const blend = t / 0.12;
                        color = {
                            r: galaxyType.coreColor.r + (galaxyType.innerColor.r - galaxyType.coreColor.r) * blend,
                            g: galaxyType.coreColor.g + (galaxyType.innerColor.g - galaxyType.coreColor.g) * blend,
                            b: galaxyType.coreColor.b + (galaxyType.innerColor.b - galaxyType.coreColor.b) * blend
                        };
                    } else if (t < 0.65) {
                        const blend = (t - 0.12) / 0.53;
                        color = {
                            r: galaxyType.innerColor.r + (galaxyType.outerColor.r - galaxyType.innerColor.r) * blend,
                            g: galaxyType.innerColor.g + (galaxyType.outerColor.g - galaxyType.innerColor.g) * blend,
                            b: galaxyType.innerColor.b + (galaxyType.outerColor.b - galaxyType.innerColor.b) * blend
                        };
                    } else {
                        color = galaxyType.outerColor;
                    }
                    
                    if (Math.random() < 0.18 * (1 + t * 0.5)) {
                        color = {
                            r: galaxyType.dustColor.r * (0.7 + Math.random() * 0.3),
                            g: galaxyType.dustColor.g * (0.7 + Math.random() * 0.3),
                            b: galaxyType.dustColor.b * (0.7 + Math.random() * 0.3)
                        };
                    }
                    
                    const brightness = 1.4 - t * 0.5 + Math.random() * 0.2;
                    armColors[actualPointCount * 3] = color.r * brightness;
                    armColors[actualPointCount * 3 + 1] = color.g * brightness;
                    armColors[actualPointCount * 3 + 2] = color.b * brightness;
                    
                    const baseSize = (1 - t * 0.85) * 14 * (1 + densityFalloff * 0.8);
                    const sizeVariation = Math.pow(Math.random(), 2) * 6 * (1 - t * 0.5);
                    armSizes[actualPointCount] = baseSize + sizeVariation;
                    
                    actualPointCount++;
                }
                
                const finalPositions = new Float32Array(actualPointCount * 3);
                const finalColors = new Float32Array(actualPointCount * 3);
                const finalSizes = new Float32Array(actualPointCount);
                
                for (let i = 0; i < actualPointCount; i++) {
                    finalPositions[i * 3] = armPositions[i * 3];
                    finalPositions[i * 3 + 1] = armPositions[i * 3 + 1];
                    finalPositions[i * 3 + 2] = armPositions[i * 3 + 2];
                    finalColors[i * 3] = armColors[i * 3];
                    finalColors[i * 3 + 1] = armColors[i * 3 + 1];
                    finalColors[i * 3 + 2] = armColors[i * 3 + 2];
                    finalSizes[i] = armSizes[i];
                }
                
                armGeometry.setAttribute('position', new THREE.BufferAttribute(finalPositions, 3));
                armGeometry.setAttribute('color', new THREE.BufferAttribute(finalColors, 3));
                armGeometry.setAttribute('size', new THREE.BufferAttribute(finalSizes, 1));
                
                const armMaterial = new THREE.PointsMaterial({
                    size: 9,
                    vertexColors: true,
                    transparent: true,
                    opacity: config.galaxyOpacity * 1.5,
                    blending: THREE.AdditiveBlending,
                    depthTest: true,
                    depthWrite: false,
                    sizeAttenuation: true,
                    map: this.createGalaxyTexture()
                });
                
                const armMesh = new THREE.Points(armGeometry, armMaterial);
                armMesh.userData = { baseOpacity: config.galaxyOpacity * 1.5 };
                galaxy.add(armMesh);
            }
            
            // Realistischer galaktischer Kern (Bulge)
            const coreGeometry = new THREE.BufferGeometry();
            const coreCount = 350;
            const corePositions = new Float32Array(coreCount * 3);
            const coreColors = new Float32Array(coreCount * 3);
            const coreSizes = new Float32Array(coreCount);
            
            for (let i = 0; i < coreCount; i++) {
                const r = Math.pow(Math.random(), 1.2) * 0.18;
                const theta = Math.random() * Math.PI * 2;
                const phi = Math.acos(2 * Math.random() - 1);
                
                corePositions[i * 3] = r * Math.sin(phi) * Math.cos(theta);
                corePositions[i * 3 + 1] = r * Math.sin(phi) * Math.sin(theta);
                corePositions[i * 3 + 2] = r * Math.cos(phi) * 0.6;
                
                const coreBrightness = 1.6 - (r / 0.18) * 0.6 + Math.random() * 0.2;
                coreColors[i * 3] = galaxyType.coreColor.r * coreBrightness;
                coreColors[i * 3 + 1] = galaxyType.coreColor.g * coreBrightness;
                coreColors[i * 3 + 2] = galaxyType.coreColor.b * coreBrightness;
                
                const sizeBase = config.galaxyCoreSize * 1.8 * (1 - r / 0.18);
                coreSizes[i] = sizeBase * (0.6 + Math.random() * 0.8);
            }
            
            coreGeometry.setAttribute('position', new THREE.BufferAttribute(corePositions, 3));
            coreGeometry.setAttribute('color', new THREE.BufferAttribute(coreColors, 3));
            coreGeometry.setAttribute('size', new THREE.BufferAttribute(coreSizes, 1));
            
            const coreMaterial = new THREE.PointsMaterial({
                size: 24,
                vertexColors: true,
                transparent: true,
                opacity: config.galaxyOpacity * 2.5,
                blending: THREE.AdditiveBlending,
                depthTest: true,
                depthWrite: false,
                sizeAttenuation: true,
                map: this.createGalaxyTexture()
            });
            
            const coreMesh = new THREE.Points(coreGeometry, coreMaterial);
            coreMesh.userData = { baseOpacity: config.galaxyOpacity * 2.5 };
            galaxy.add(coreMesh);
            
            galaxy.userData = {
                baseX: x,
                baseY: y,
                baseZ: z,
                velocity: Math.random() * 0.2 + 0.1,
                rotationSpeed: config.galaxyRotationSpeed * (Math.random() * 0.5 + 0.75),
                fadeIn: 0,
                type: galaxyType.name
            };
            
            return galaxy;
        }
        
        calculateDepthOpacity(z) {
            const maxDistance = config.starDepthRange / 2;
            const minOpacity = config.starBaseOpacity;
            const normalizedDistance = Math.min(1, Math.abs(z) / maxDistance);
            return 1 - (normalizedDistance * (1 - minOpacity));
        }
        
        createNebula() {
            const nebulaCount = Math.min(config.nebulaCount, 500);
            this.nebulaPositions = new Float32Array(nebulaCount * 3);
            this.nebulaColors = new Float32Array(nebulaCount * 3);
            this.nebulaOriginalPositions = new Float32Array(nebulaCount * 3);
            this.nebulaBaseColors = new Float32Array(nebulaCount * 3);
            this.nebulaTrailData = [];
            
            for (let i = 0; i < nebulaCount; i++) {
                const i3 = i * 3;
                
                const angle = Math.random() * Math.PI * 2;
                const radius = Math.random() * (config.nebulaMaxRadius - config.nebulaMinRadius) + config.nebulaMinRadius;
                const depth = (Math.random() * config.starDepthRange) - (config.starDepthRange / 2);
                
                this.nebulaPositions[i3] = Math.cos(angle) * radius;
                this.nebulaPositions[i3 + 1] = Math.sin(angle) * radius;
                this.nebulaPositions[i3 + 2] = depth;
                
                this.nebulaOriginalPositions[i3] = this.nebulaPositions[i3];
                this.nebulaOriginalPositions[i3 + 1] = this.nebulaPositions[i3 + 1];
                this.nebulaOriginalPositions[i3 + 2] = this.nebulaPositions[i3 + 2];
                
                const colorType = Math.random();
                let baseColor, warpColor;
                if (colorType < 0.33) {
                    baseColor = config.colors.nebula.purple;
                    warpColor = Math.random() < 0.50 ? config.colors.nebula.warpViolet : config.colors.nebula.warpRed;
                } else if (colorType < 0.66) {
                    baseColor = config.colors.nebula.blue;
                    warpColor = Math.random() < 0.50 ? config.colors.nebula.warpViolet : config.colors.nebula.warpRed;
                } else {
                    baseColor = config.colors.nebula.pink;
                    warpColor = Math.random() < 0.50 ? config.colors.nebula.warpViolet : config.colors.nebula.warpRed;
                }
                
                this.nebulaBaseColors[i3] = baseColor.r;
                this.nebulaBaseColors[i3 + 1] = baseColor.g;
                this.nebulaBaseColors[i3 + 2] = baseColor.b;
                
                this.nebulaColors[i3] = baseColor.r;
                this.nebulaColors[i3 + 1] = baseColor.g;
                this.nebulaColors[i3 + 2] = baseColor.b;
                
                this.nebulaTrailData.push({
                    originalX: this.nebulaPositions[i3],
                    originalY: this.nebulaPositions[i3 + 1],
                    originalZ: this.nebulaPositions[i3 + 2],
                    trailLength: 0,
                    maxTrailLength: Math.random() * 500 + 200,
                    warpColorR: warpColor.r,
                    warpColorG: warpColor.g,
                    warpColorB: warpColor.b
                });
            }
            
            const geometry = new THREE.BufferGeometry();
            geometry.setAttribute('position', new THREE.BufferAttribute(this.nebulaPositions, 3));
            geometry.setAttribute('color', new THREE.BufferAttribute(this.nebulaColors, 3));
            
            const canvas = document.createElement('canvas');
            canvas.width = 512;
            canvas.height = 512;
            const ctx = canvas.getContext('2d');
            
            const gradient = ctx.createRadialGradient(256, 256, 0, 256, 256, 256);
            gradient.addColorStop(0, 'rgba(255, 255, 255, 0.5)');
            gradient.addColorStop(0.2, 'rgba(255, 255, 255, 0.3)');
            gradient.addColorStop(0.4, 'rgba(255, 255, 255, 0.15)');
            gradient.addColorStop(1, 'rgba(255, 255, 255, 0)');
            
            ctx.fillStyle = gradient;
            ctx.fillRect(0, 0, 512, 512);
            
            const texture = new THREE.CanvasTexture(canvas);
            
            this.nebulaMaterial = new THREE.PointsMaterial({
                size: config.nebulaBaseSize,
                vertexColors: true,
                transparent: true,
                opacity: config.nebulaBaseOpacity,
                blending: THREE.AdditiveBlending,
                depthWrite: false,
                sizeAttenuation: true,
                map: texture
            });
            
            this.nebula = new THREE.Points(geometry, this.nebulaMaterial);
            this.scene.add(this.nebula);
        }
        
        createNebulaTrails() {
            this.nebulaTrails.forEach(trail => this.scene.remove(trail));
            this.nebulaTrails = [];
            
            const warpIntensity = Math.min(1.0, Math.max(0.0, (this.currentSpeed - this.idleSpeed) / (this.warpSpeed - this.idleSpeed)));
            
            if (warpIntensity > 0.1) {
                for (let i = 0; i < this.nebulaTrailData.length; i += 3) {
                    const nebulaIndex = Math.floor(i / 3);
                    const trailData = this.nebulaTrailData[nebulaIndex];
                    
                    const currentX = this.nebulaPositions[nebulaIndex * 3];
                    const currentY = this.nebulaPositions[nebulaIndex * 3 + 1];
                    const currentZ = this.nebulaPositions[nebulaIndex * 3 + 2];
                    
                    const trailLength = trailData.maxTrailLength * warpIntensity;
                    
                    if (trailLength > 10) {
                        const geometry = new THREE.BufferGeometry();
                        const positions = new Float32Array([
                            currentX, currentY, currentZ,
                            currentX, currentY, currentZ - trailLength
                        ]);
                        
                        geometry.setAttribute('position', new THREE.BufferAttribute(positions, 3));
                        
                        const material = new THREE.LineBasicMaterial({
                            color: new THREE.Color(
                                this.nebulaColors[nebulaIndex * 3],
                                this.nebulaColors[nebulaIndex * 3 + 1],
                                this.nebulaColors[nebulaIndex * 3 + 2]
                            ),
                            transparent: true,
                            opacity: 0.3 * warpIntensity,
                            blending: THREE.AdditiveBlending,
                            linewidth: 1
                        });
                        
                        const trail = new THREE.Line(geometry, material);
                        this.nebulaTrails.push(trail);
                        this.scene.add(trail);
                    }
                }
            }
        }
        
        updateButtonPosition() {
            this.buttonPositions = [];
            this.buttons.forEach(button => {
                const rect = button.getBoundingClientRect();
                this.buttonPositions.push({
                    x: rect.left + rect.width / 2,
                    y: rect.top + rect.height / 2 + this.scrollY,
                    rect: rect
                });
            });
        }
        
        setupEventListeners() {
            window.addEventListener('resize', () => this.onResize());
            window.addEventListener('mousemove', (e) => {
                this.mousePos.x = e.clientX;
                this.mousePos.y = e.clientY;
            });
            window.addEventListener('scroll', () => {
                this.scrollY = window.pageYOffset || window.scrollY;
                this.updateButtonPosition();
            });
            
            this.buttons.forEach(button => {
                button.addEventListener('mouseenter', () => {
                    this.targetSpeed = this.warpSpeed;
                    this.isInWarp = true;
                });
                button.addEventListener('mouseleave', () => {
                    this.targetSpeed = this.idleSpeed;
                    this.isInWarp = false;
                });
            });
        }
        
        onResize() {
            this.camera.aspect = window.innerWidth / window.innerHeight;
            this.camera.updateProjectionMatrix();
            this.renderer.setSize(window.innerWidth, window.innerHeight);
            this.updateButtonPosition();
        }
        
        getOpacity() {
            const fadeStart = window.innerHeight;
            const fadeEnd = window.innerHeight * 2;
            return 1 - Math.max(0, Math.min(1, (this.scrollY - fadeStart) / (fadeEnd - fadeStart)));
        }
        
        animate() {
            if (!this.isPaused) {
                this.time += 0.016;
                
                const lerpFactor = this.isInWarp ? 0.02 : 0.04;
                this.currentSpeed += (this.targetSpeed - this.currentSpeed) * lerpFactor;
                
                const warpIntensity = Math.min(1.0, Math.max(0.0, (this.currentSpeed - this.idleSpeed) / (this.warpSpeed - this.idleSpeed)));
                
                this.starPointsMesh.material.opacity = 1 - warpIntensity;
                this.starPointData.forEach(closeStar => {
                    closeStar.mesh.material.opacity = 1 - warpIntensity;
                });
                
                this.starData.forEach((star) => {
                    const positions = star.line.geometry.attributes.position.array;
                    
                    const distFromCenter = Math.sqrt(star.baseX * star.baseX + star.baseY * star.baseY);
                    const pushFactor = this.currentSpeed * 0.025 * star.velocity;
                    
                    const newX = star.baseX + (star.baseX / distFromCenter) * pushFactor * warpIntensity * 50;
                    const newY = star.baseY + (star.baseY / distFromCenter) * pushFactor * warpIntensity * 50;
                    
                    positions[0] = newX;
                    positions[1] = newY;
                    positions[2] += this.currentSpeed * star.velocity;
                    
                    const lineLength = 1 + (warpIntensity * 347);
                    positions[3] = newX;
                    positions[4] = newY;
                    positions[5] = positions[2] - lineLength;
                    
                    star.line.geometry.attributes.position.needsUpdate = true;
                    
                    const currentDistance = Math.sqrt(newX * newX + newY * newY);
                    
                    if (positions[2] > 1000 || currentDistance > 2000) {
                        const angle = Math.random() * Math.PI * 2;
                        const radius = Math.random() * (config.starMaxRadius - config.starMinRadius) + config.starMinRadius;
                        
                        star.baseX = Math.cos(angle) * radius;
                        star.baseY = Math.sin(angle) * radius;
                        star.angle = angle;
                        star.radius = radius;
                        
                        positions[0] = star.baseX;
                        positions[1] = star.baseY;
                        positions[2] = -2000;
                        positions[3] = star.baseX;
                        positions[4] = star.baseY;
                        positions[5] = -2000 - 3;
                    }
                    
                    const brightness = config.starBrightness + (warpIntensity * config.starWarpBrightness);
                    star.line.material.color.copy(star.baseColor).multiplyScalar(brightness);
                    
                    const opacity = this.calculateDepthOpacity(positions[2]) * warpIntensity;
                    star.line.material.opacity = opacity;
                });
                
                const pointPos = this.starPointsMesh.geometry.attributes.position;
                for (let i = 0; i < this.starData.length; i++) {
                    const star = this.starData[i];
                    pointPos.array[i * 3] = star.line.geometry.attributes.position.array[0];
                    pointPos.array[i * 3 + 1] = star.line.geometry.attributes.position.array[1];
                    pointPos.array[i * 3 + 2] = star.line.geometry.attributes.position.array[2];
                }
                pointPos.needsUpdate = true;
                
                this.starPointData.forEach(closeStar => {
                    const pos = closeStar.mesh.geometry.attributes.position.array;
                    pos[2] += this.currentSpeed * closeStar.velocity * 0.5;
                    
                    if (pos[2] > 100) {
                        const angle = Math.random() * Math.PI * 2;
                        const radius = Math.random() * 50 + 10;
                        pos[0] = Math.cos(angle) * radius;
                        pos[1] = Math.sin(angle) * radius;
                        pos[2] = -50;
                        
                        closeStar.baseX = pos[0];
                        closeStar.baseY = pos[1];
                        closeStar.baseZ = pos[2];
                    }
                    
                    closeStar.mesh.geometry.attributes.position.needsUpdate = true;
                });
                
                const nebulaPos = this.nebula.geometry.attributes.position;
                const nebulaCol = this.nebula.geometry.attributes.color;
                
                for (let i = 0; i < nebulaPos.count; i++) {
                    const i3 = i * 3;
                    
                    const baseR = this.nebulaBaseColors[i3];
                    const baseG = this.nebulaBaseColors[i3 + 1];
                    const baseB = this.nebulaBaseColors[i3 + 2];
                    
                    const trailData = this.nebulaTrailData[i];
                    const targetR = trailData.warpColorR;
                    const targetG = trailData.warpColorG;
                    const targetB = trailData.warpColorB;
                    
                    nebulaCol.array[i3] = baseR + (targetR - baseR) * warpIntensity;
                    nebulaCol.array[i3 + 1] = baseG + (targetG - baseG) * warpIntensity;
                    nebulaCol.array[i3 + 2] = baseB + (targetB - baseB) * warpIntensity;
                    
                    const x = nebulaPos.array[i3];
                    const y = nebulaPos.array[i3 + 1];
                    
                    const distanceFromCenter = Math.sqrt(x * x + y * y);
                    const pushFactor = this.currentSpeed * 0.012;
                    
                    if (distanceFromCenter > 0) {
                        nebulaPos.array[i3] += (x / distanceFromCenter) * pushFactor * warpIntensity;
                        nebulaPos.array[i3 + 1] += (y / distanceFromCenter) * pushFactor * warpIntensity;
                    }
                    
                    const stretchFactor = 1 + (warpIntensity * 5);
                    nebulaPos.array[i3 + 2] += this.currentSpeed * 0.1 * stretchFactor;
                    
                    const newDistance = Math.sqrt(nebulaPos.array[i3] * nebulaPos.array[i3] + nebulaPos.array[i3 + 1] * nebulaPos.array[i3 + 1]);
                    
                    if (nebulaPos.array[i3 + 2] > 1000 || newDistance > 2000) {
                        const angle = Math.random() * Math.PI * 2;
                        const radius = Math.random() * (config.nebulaMaxRadius - config.nebulaMinRadius) + config.nebulaMinRadius;
                        
                        nebulaPos.array[i3] = Math.cos(angle) * radius;
                        nebulaPos.array[i3 + 1] = Math.sin(angle) * radius;
                        nebulaPos.array[i3 + 2] = -2000;
                        
                        this.nebulaTrailData[i].originalX = nebulaPos.array[i3];
                        this.nebulaTrailData[i].originalY = nebulaPos.array[i3 + 1];
                        this.nebulaTrailData[i].originalZ = nebulaPos.array[i3 + 2];
                    }
                }
                nebulaPos.needsUpdate = true;
                nebulaCol.needsUpdate = true;
                
                if (this.isInWarp || warpIntensity > 0.1) {
                    this.createNebulaTrails();
                } else {
                    this.nebulaTrails.forEach(trail => this.scene.remove(trail));
                    this.nebulaTrails = [];
                }
                
                const baseOpacity = this.getOpacity() * config.nebulaBaseOpacity;
                const warpOpacityBoost = warpIntensity * 0.01;
                this.nebulaMaterial.opacity = baseOpacity + warpOpacityBoost;
                
                this.nebulaMaterial.size = config.nebulaBaseSize + (warpIntensity * 600);
                
                if (config.galaxiesEnabled && this.galaxyGroup) {
                    const shouldSpawn = warpIntensity > 0.3 ? (Math.random() < 0.01) : (Math.random() < 0.002);
                    
                    if (shouldSpawn) {
                        this.spawnGalaxy();
                    }
                    
                    for (let i = this.galaxies.length - 1; i >= 0; i--) {
                        const galaxy = this.galaxies[i];
                        
                        galaxy.userData.fadeIn = Math.min(1, galaxy.userData.fadeIn + 0.02);
                        
                        const speedMultiplier = warpIntensity > 0.1 ? 1.0 : 0.15;
                        galaxy.position.z += this.currentSpeed * galaxy.userData.velocity * config.galaxySpeed * speedMultiplier;
                        
                        galaxy.rotation.z += galaxy.userData.rotationSpeed;
                        
                        galaxy.children.forEach(child => {
                            if (child.material) {
                                child.material.opacity = child.userData.baseOpacity * galaxy.userData.fadeIn;
                            }
                        });
                        
                        if (galaxy.position.z > 1000) {
                            this.galaxyGroup.remove(galaxy);
                            this.galaxies.splice(i, 1);
                        }
                    }
                }
                
                let targetCameraX = 0;
                let targetCameraY = 0;
                
                if (this.buttonPositions.length > 0) {
                    const primaryButton = this.buttonPositions[0];
                    targetCameraX = (primaryButton.x - window.innerWidth / 2) * 0.5;
                    targetCameraY = ((primaryButton.y - this.scrollY) - window.innerHeight / 2) * 0.5;
                }
                
                this.cameraOffset.x += (targetCameraX - this.cameraOffset.x) * 0.05;
                this.cameraOffset.y += (targetCameraY - this.cameraOffset.y) * 0.05;
                
                if (this.perspectiveEnabled) {
                    const parallaxX = (this.mousePos.x / window.innerWidth - 0.5) * this.parallaxIntensity;
                    const parallaxY = (this.mousePos.y / window.innerHeight - 0.5) * this.parallaxIntensity;
                    
                    this.camera.position.x = this.cameraOffset.x + parallaxX;
                    this.camera.position.y = this.cameraOffset.y + parallaxY;
                }
                
                if (this.isInWarp) {
                    this.camera.rotation.z = Math.sin(this.time * 2) * 0.02;
                    this.camera.fov = config.cameraFOV + (warpIntensity * 20);
                    this.camera.updateProjectionMatrix();
                } else {
                    this.camera.rotation.z *= 0.95;
                    this.camera.fov += (config.cameraFOV - this.camera.fov) * 0.05;
                    this.camera.updateProjectionMatrix();
                }
                
                this.starLines.rotation.z += 0.0001;
                this.starPoints.rotation.z += 0.0001;
                this.nebula.rotation.z -= 0.00005;
            }
            
            this.renderer.render(this.scene, this.camera);
            requestAnimationFrame(() => this.animate());
        }
        
        spawnGalaxy() {
            if (!config.galaxiesEnabled || !this.galaxyGroup) return;
            
            if (this.galaxies.length < config.galaxyCount) {
                const galaxy = this.createGalaxy();
                if (galaxy) {
                    this.galaxyGroup.add(galaxy);
                    this.galaxies.push(galaxy);
                }
            }
        }
        
        pause() {
            this.isPaused = true;
        }
        
        resume() {
            this.isPaused = false;
        }
    }
    
    document.addEventListener('DOMContentLoaded', function() {
        const canvas = document.getElementById('starfield-canvas');
        if (canvas) {
            window.axaiStarfield = new AxAIStarfield(canvas);
            
            // Pause/Play Button Event Listener
            const pauseButton = document.getElementById('pauseButton');
            if (pauseButton) {
                pauseButton.addEventListener('click', function() {
                    if (window.axaiStarfield) {
                        if (window.axaiStarfield.isPaused) {
                            window.axaiStarfield.resume();
                            this.innerHTML = '⏸';
                            this.title = 'Animation pausieren';
                        } else {
                            window.axaiStarfield.pause();
                            this.innerHTML = '▶';
                            this.title = 'Animation fortsetzen';
                        }
                    }
                });
            }
        }
    });
    
})();