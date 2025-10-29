// Enhanced JavaScript for Ndawonga Website

class ParallaxController {
    constructor() {
        this.mouseX = 0;
        this.mouseY = 0;
        this.init();
    }
    init() {
        document.addEventListener('mousemove', (e) => {
            this.mouseX = (e.clientX - window.innerWidth / 2) / 25;
            this.mouseY = (e.clientY - window.innerHeight / 2) / 25;
            this.updateParallax();
        });
    }
    updateParallax() {
        const elements = document.querySelectorAll('.parallax-element');
        elements.forEach((element, index) => {
            const speed = (index + 1) * 0.5;
            const x = this.mouseX * speed;
            const y = this.mouseY * speed;
            element.style.transform = `translateX(${x}px) translateY(${y}px)`;
        });
    }
}

class AdvancedChatbot {
    constructor() {
        this.conversationHistory = [];
        this.userPreferences = {};
        this.init();
    }
    init() {
        this.loadConversationHistory();
        this.setupEventListeners();
    }
    setupEventListeners() {
        document.getElementById('sendMessage')?.addEventListener('click', () => this.handleUserMessage());
        document.getElementById('chatbotInput')?.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') this.handleUserMessage();
        });
        document.getElementById('chatbotToggle')?.addEventListener('click', () => {
            document.getElementById('chatbotContainer')?.classList.toggle('active');
        });
        document.getElementById('closeChatbot')?.addEventListener('click', () => {
            document.getElementById('chatbotContainer')?.classList.remove('active');
        });
    }
    async handleUserMessage() {
        const input = document.getElementById('chatbotInput');
        if (!input) return;
        const message = input.value.trim();
        if (!message) return;
        this.addMessage(message, true);
        this.saveToHistory(message, 'user');
        input.value = '';
        this.showTypingIndicator();
        const response = await this.generateAIResponse(message);
        this.hideTypingIndicator();
        this.addMessage(response, false);
        this.saveToHistory(response, 'bot');
    }
    async generateAIResponse(message) {
        return new Promise((resolve) => {
            setTimeout(() => {
                const responses = this.getEnhancedResponses(message);
                const randomResponse = responses[Math.floor(Math.random() * responses.length)];
                resolve(randomResponse);
            }, 800 + Math.random() * 1000);
        });
    }
    getEnhancedResponses(message) {
        const lower = message.toLowerCase();
        if (lower.includes('project') && lower.includes('cost')) {
            return [
                "For accurate project costing, try our AI Estimator below. Want help?",
                "Costs vary by scale and complexity. The estimator can give you a quick quote.",
                "I can help estimate costs. Is it civil, construction, or waste management?"
            ];
        }
        if (lower.includes('timeline') || lower.includes('duration')) {
            return [
                "Timelines depend on scope. Typical projects span 6–24 months.",
                "We deliver on time. Need an estimate for your specific scope?",
                "Our PMO optimizes schedules. What project scale are you planning?"
            ];
        }
        if (lower.includes('certificate') || lower.includes('compliance') || lower.includes('cidb') || lower.includes('bee')) {
            return [
                "We are B-BBEE Level 1, CIDB registered, and ISO 9001:2015 certified.",
                "All compliance docs available for tender submissions. Which one do you need?",
                "Certified and compliant for both public and private sector."
            ];
        }
        return [
            "Great question! I can connect you with our experts or share details.",
            "Our portfolio includes similar work. Want links to relevant case studies?",
            "I'd be happy to help further. What outcome are you aiming for?"
        ];
    }
    getLastUserMessage() {
        const userMessages = this.conversationHistory.filter(m => m.sender === 'user');
        return userMessages.length ? userMessages[userMessages.length - 1].message : '';
    }
    showTypingIndicator() {
        const div = document.createElement('div');
        div.className = 'message bot-message typing-indicator';
        div.innerHTML = '<div class="message-content"><div class="typing-dots"><span></span><span></span><span></span></div></div>';
        document.getElementById('chatbotMessages')?.appendChild(div);
        const m = document.getElementById('chatbotMessages');
        if (m) m.scrollTop = m.scrollHeight;
    }
    hideTypingIndicator() {
        document.querySelector('.typing-indicator')?.remove();
    }
    addMessage(message, isUser) {
        const messageDiv = document.createElement('div');
        messageDiv.className = `message ${isUser ? 'user-message' : 'bot-message'}`;
        const contentDiv = document.createElement('div');
        contentDiv.className = 'message-content';
        contentDiv.textContent = message;
        messageDiv.appendChild(contentDiv);
        const box = document.getElementById('chatbotMessages');
        if (box) {
            box.appendChild(messageDiv);
            box.scrollTop = box.scrollHeight;
        }
    }
    saveToHistory(message, sender) {
        this.conversationHistory.push({ message, sender, timestamp: new Date().toISOString() });
        if (this.conversationHistory.length > 50) this.conversationHistory = this.conversationHistory.slice(-50);
        localStorage.setItem('chatbotHistory', JSON.stringify(this.conversationHistory));
    }
    loadConversationHistory() {
        const saved = localStorage.getItem('chatbotHistory');
        if (saved) this.conversationHistory = JSON.parse(saved);
    }
}

class ProjectVisualizer {
    constructor() {
        this.projects = [];
        this.currentProject = 0;
        this.init();
    }
    async init() {
        await this.loadProjects();
        this.setupVisualizer();
    }
    async loadProjects() {
        this.projects = [
            { id: 1, title: 'Johannesburg Highway Expansion', type: 'road', budget: 'R 15,000,000', duration: '18 months', status: 'completed', description: 'Expansion of 8km highway section with modern drainage systems', impact: 'Reduced traffic congestion by 40%' },
            { id: 2, title: 'Eco Waste Management Facility', type: 'recycle', budget: 'R 8,500,000', duration: '12 months', status: 'completed', description: 'State-of-the-art recycling plant with zero waste policy', impact: '90% waste diversion from landfills' }
        ];
    }
    setupVisualizer() {
        this.createVisualizerUI();
        this.bindEvents();
        this.renderProject();
    }
    createVisualizerUI() {
        const html = `
            <div class="project-visualizer">
                <div class="visualizer-header">
                    <h4>Project Visualizer</h4>
                    <div class="visualizer-controls">
                        <button class="btn-control prev-project"><i class="fas fa-chevron-left"></i></button>
                        <button class="btn-control next-project"><i class="fas fa-chevron-right"></i></button>
                    </div>
                </div>
                <div class="visualizer-content">
                    <div class="project-canvas" id="projectCanvas"></div>
                    <div class="project-info">
                        <h5 id="visualizerTitle">Project Title</h5>
                        <div class="project-stats">
                            <div class="stat"><label>Budget</label><span id="visualizerBudget">R 0</span></div>
                            <div class="stat"><label>Duration</label><span id="visualizerDuration">0 months</span></div>
                            <div class="stat"><label>Status</label><span id="visualizerStatus" class="status-completed">Completed</span></div>
                        </div>
                        <p id="visualizerDescription">Project description will appear here.</p>
                        <div class="project-impact"><i class="fas fa-chart-line"></i><span id="visualizerImpact">Project impact metrics</span></div>
                    </div>
                </div>
            </div>`;
        const section = document.querySelector('.section-projects');
        if (section) section.insertAdjacentHTML('beforeend', html);
    }
    bindEvents() {
        document.querySelector('.prev-project')?.addEventListener('click', () => this.previousProject());
        document.querySelector('.next-project')?.addEventListener('click', () => this.nextProject());
    }
    nextProject() { this.currentProject = (this.currentProject + 1) % this.projects.length; this.renderProject(); }
    previousProject() { this.currentProject = (this.currentProject - 1 + this.projects.length) % this.projects.length; this.renderProject(); }
    renderProject() {
        const p = this.projects[this.currentProject];
        const set = (id, v) => { const el = document.getElementById(id); if (el) el.textContent = v; };
        set('visualizerTitle', p.title);
        set('visualizerBudget', p.budget);
        set('visualizerDuration', p.duration);
        set('visualizerStatus', p.status);
        const statusEl = document.getElementById('visualizerStatus');
        if (statusEl) statusEl.className = `status-${p.status.toLowerCase()}`;
        set('visualizerDescription', p.description);
        set('visualizerImpact', p.impact);
        this.render3DVisualization(p);
    }
    render3DVisualization(project) {
        const canvas = document.getElementById('projectCanvas');
        if (!canvas) return;
        canvas.innerHTML = `<div class="project-3d-placeholder"><i class="fas fa-${project.type} fa-4x"></i><p>3D Project Visualization</p><div class="construction-animation"><div class=\"construction-bar\"></div><div class=\"construction-bar\"></div><div class=\"construction-bar\"></div></div></div>`;
    }
}

class CollaborationManager {
    constructor() {
        this.teamMembers = [];
        this.activeUsers = new Set();
        this.init();
    }
    async init() {
        await this.loadTeamMembers();
        this.setupCollaboration();
    }
    async loadTeamMembers() {
        this.teamMembers = [
            { id: 1, name: 'David Banda', role: 'Operations Director', online: true },
            { id: 2, name: 'Thato Manda', role: 'HR Director', online: false },
            { id: 3, name: 'Mike Msisinyane', role: 'Construction Manager', online: true }
        ];
    }
    setupCollaboration() {
        this.renderTeamPresence();
        this.setupLiveChat();
    }
    renderTeamPresence() {
        const html = `
            <div class="team-presence-widget">
                <h6>Team Online</h6>
                <div class="online-members">
                    ${this.teamMembers.filter(m => m.online).map(m => `
                        <div class="online-member">
                            <div class="member-avatar">${m.name.charAt(0)}<div class="online-indicator"></div></div>
                            <div class="member-info"><span class="member-name">${m.name}</span><span class="member-role">${m.role}</span></div>
                        </div>
                    `).join('')}
                </div>
                <button class="btn-collaborate"><i class="fas fa-comments"></i> Start Collaboration</button>
            </div>`;
        const contactSection = document.querySelector('.contact-section');
        if (contactSection) contactSection.insertAdjacentHTML('beforeend', html);
    }
    setupLiveChat() {
        document.querySelector('.btn-collaborate')?.addEventListener('click', () => this.openCollaborationRoom());
    }
    openCollaborationRoom() {
        const html = `
            <div class="collaboration-room">
                <div class="room-header"><h5>Live Collaboration</h5><button class="close-room"><i class="fas fa-times"></i></button></div>
                <div class="room-content">
                    <div class="video-grid"><div class="video-placeholder"><i class="fas fa-video"></i><p>Live Video Feed</p></div></div>
                    <div class="collaboration-chat"><div class="chat-messages"></div><div class="chat-input"><input type="text" placeholder="Type your message..."><button><i class="fas fa-paper-plane"></i></button></div></div>
                </div>
            </div>`;
        document.body.insertAdjacentHTML('beforeend', html);
        document.querySelector('.close-room')?.addEventListener('click', () => document.querySelector('.collaboration-room')?.remove());
    }
}

document.addEventListener('DOMContentLoaded', function() {
    new ParallaxController();
    new AdvancedChatbot();
    new ProjectVisualizer();
    new CollaborationManager();
    createFloatingActions();
});

function createFloatingActions() {
    const html = `
        <div class="floating-actions">
            <button class="floating-action" id="quickQuote" title="Quick Quote"><i class="fas fa-calculator"></i></button>
            <button class="floating-action" id="scheduleCall" title="Schedule Call"><i class="fas fa-phone"></i></button>
            <button class="floating-action" id="downloadProfile" title="Company Profile"><i class="fas fa-download"></i></button>
        </div>`;
    document.body.insertAdjacentHTML('beforeend', html);
    document.getElementById('quickQuote')?.addEventListener('click', () => document.querySelector('.section-estimator')?.scrollIntoView({ behavior: 'smooth' }));
    document.getElementById('scheduleCall')?.addEventListener('click', () => window.open('tel:+27111234567', '_self'));
    document.getElementById('downloadProfile')?.addEventListener('click', () => {
        const link = document.createElement('a');
        link.href = '#';
        link.download = 'Ndawonga-Company-Profile.pdf';
        link.click();
        showNotification('Company profile download started!', 'success');
    });
}

function showNotification(message, type = 'info') {
    const div = document.createElement('div');
    div.className = `notification notification-${type}`;
    div.innerHTML = `<div class="notification-content"><i class="fas fa-${type === 'success' ? 'check-circle' : 'info-circle'}"></i><span>${message}</span></div><button class="notification-close"><i class="fas fa-times"></i></button>`;
    document.body.appendChild(div);
    setTimeout(() => div.classList.add('show'), 100);
    setTimeout(() => { div.classList.remove('show'); setTimeout(() => div.remove(), 300); }, 5000);
    div.querySelector('.notification-close')?.addEventListener('click', () => { div.classList.remove('show'); setTimeout(() => div.remove(), 300); });
}

// Inject enhanced styles specific to JS widgets
(() => {
    const styles = `
    .typing-indicator .message-content{background:transparent!important;border:none!important}
    .typing-dots{display:flex;gap:4px}
    .typing-dots span{width:8px;height:8px;border-radius:50%;background:#cbd5e0;animation:typing-dot 1.4s ease-in-out infinite both}
    .typing-dots span:nth-child(1){animation-delay:-.32s}.typing-dots span:nth-child(2){animation-delay:-.16s}
    @keyframes typing-dot{0%,80%,100%{transform:scale(.8);opacity:.5}40%{transform:scale(1);opacity:1}}
    .project-visualizer{background:#fff;border-radius:20px;padding:30px;margin:40px 0;box-shadow:var(--shadow-medium)}
    .visualizer-header{display:flex;justify-content:space-between;align-items:center;margin-bottom:25px}
    .visualizer-controls{display:flex;gap:10px}
    .btn-control{width:40px;height:40px;border:2px solid var(--primary-color);background:#fff;color:var(--primary-color);border-radius:50%;display:flex;align-items:center;justify-content:center;cursor:pointer;transition:all .3s ease}
    .btn-control:hover{background:var(--primary-color);color:#fff}
    .visualizer-content{display:grid;grid-template-columns:1fr 1fr;gap:30px}
    .project-canvas{background:#f8fafc;border-radius:15px;min-height:300px;display:flex;align-items:center;justify-content:center}
    .project-3d-placeholder{text-align:center;color:var(--primary-color)}
    .construction-animation{display:flex;justify-content:center;gap:5px;margin-top:20px}
    .construction-bar{width:8px;height:30px;background:var(--gold-color);animation:construction 1s ease-in-out infinite}
    .construction-bar:nth-child(2){animation-delay:.2s}.construction-bar:nth-child(3){animation-delay:.4s}
    @keyframes construction{0%,100%{transform:scaleY(.5)}50%{transform:scaleY(1.5)}}
    .project-stats{display:grid;grid-template-columns:1fr 1fr;gap:15px;margin:20px 0}
    .stat{text-align:center;padding:15px;background:#f8fafc;border-radius:10px}
    .stat label{display:block;font-size:.8rem;color:#718096;margin-bottom:5px}
    .stat span{font-weight:700;color:var(--primary-color)}
    .status-completed{color:var(--success-color);font-weight:600}
    .status-ongoing{color:var(--warning-color);font-weight:600}
    .project-impact{display:flex;align-items:center;gap:10px;padding:15px;background:var(--gradient-success);color:#fff;border-radius:10px;margin-top:15px}
    .floating-actions{position:fixed;bottom:100px;right:30px;display:flex;flex-direction:column;gap:15px;z-index:999}
    .floating-action{width:60px;height:60px;background:var(--gradient-primary);color:#fff;border:none;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:1.2rem;cursor:pointer;box-shadow:var(--shadow-medium);transition:all .3s ease;position:relative}
    .floating-action:hover{transform:scale(1.1);background:var(--secondary-color)}
    .floating-action::after{content:attr(title);position:absolute;right:70px;background:var(--primary-color);color:#fff;padding:8px 12px;border-radius:6px;font-size:.8rem;white-space:nowrap;opacity:0;transform:translateX(10px);transition:all .3s ease;pointer-events:none}
    .floating-action:hover::after{opacity:1;transform:translateX(0)}
    .notification{position:fixed;top:100px;right:30px;background:#fff;border-radius:10px;padding:20px;box-shadow:var(--shadow-heavy);display:flex;align-items:center;gap:15px;max-width:350px;transform:translateX(400px);transition:all .3s ease;z-index:10000}
    .notification.show{transform:translateX(0)}
    .notification-success{border-left:4px solid var(--success-color)}
    .notification-info{border-left:4px solid var(--primary-color)}
    .notification-content{flex:1;display:flex;align-items:center;gap:10px}
    .notification-close{background:none;border:none;color:#718096;cursor:pointer;padding:5px}
    .notification-close:hover{color:var(--primary-color)}
    @media (max-width:768px){.visualizer-content{grid-template-columns:1fr}.floating-actions{bottom:80px;right:15px}.floating-action{width:50px;height:50px;font-size:1rem}}
    `;
    const s = document.createElement('style');
    s.textContent = styles;
    document.head.appendChild(s);
})();


