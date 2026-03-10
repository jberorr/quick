/* ====================================================================
   Quick PC Service - Modern JS Enhancements
   Enhanced Functionality & Animations
   ==================================================================== */

document.addEventListener('DOMContentLoaded', function() {
    // Initialize all modern enhancements
    initializeModernUI();
    initializeAnimations();
    initializeFormValidation();
    initializeTooltips();
});

/* ====== Modern UI Initialization ====== */
function initializeModernUI() {
    // Smooth scroll behavior
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });

    // Add loading state to buttons
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function() {
            const buttons = this.querySelectorAll('button[type="submit"]');
            buttons.forEach(btn => {
                btn.setAttribute('data-original-text', btn.innerHTML);
                btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Processing...';
                btn.disabled = true;
            });
        });
    });

    // Initialize card animations
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-fade-in');
            }
        });
    });

    document.querySelectorAll('.ibox, .card').forEach(card => {
        observer.observe(card);
    });
}

/* ====== Smooth Animations ====== */
function initializeAnimations() {
    // Fade in elements on scroll
    const fadeElements = document.querySelectorAll('[data-animate="fade-in"]');
    const scrollObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.animation = 'fadeIn 0.5s ease forwards';
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });

    fadeElements.forEach(el => scrollObserver.observe(el));

    // Slide animations
    document.querySelectorAll('[data-animate="slide-up"]').forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(20px)';
        const observer = new IntersectionObserver((entries) => {
            if (entries[0].isIntersecting) {
                el.style.transition = 'all 0.6s ease';
                el.style.opacity = '1';
                el.style.transform = 'translateY(0)';
            }
        });
        observer.observe(el);
    });
}

/* ====== Form Validation ====== */
function initializeFormValidation() {
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function(e) {
            let isValid = true;
            
            // Check required fields
            this.querySelectorAll('[required]').forEach(field => {
                if (!field.value.trim()) {
                    isValid = false;
                    field.classList.add('has-error');
                    showFieldError(field, 'This field is required');
                } else {
                    field.classList.remove('has-error');
                    clearFieldError(field);
                }
            });

            // Email validation
            this.querySelectorAll('input[type="email"]').forEach(field => {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (field.value && !emailRegex.test(field.value)) {
                    isValid = false;
                    field.classList.add('has-error');
                    showFieldError(field, 'Please enter a valid email address');
                }
            });

            // Phone validation
            this.querySelectorAll('input[type="tel"]').forEach(field => {
                const phoneRegex = /^[\d\s\-\+\(\)]+$/;
                if (field.value && !phoneRegex.test(field.value)) {
                    isValid = false;
                    field.classList.add('has-error');
                    showFieldError(field, 'Please enter a valid phone number');
                }
            });

            if (!isValid) {
                e.preventDefault();
                showNotification('Please correct the errors and try again', 'warning');
            }
        });

        // Remove error on input
        form.querySelectorAll('input, textarea, select').forEach(field => {
            field.addEventListener('change', function() {
                this.classList.remove('has-error');
                clearFieldError(this);
            });
        });
    });
}

function showFieldError(field, message) {
    const errorContainer = field.parentElement;
    let errorMsg = errorContainer.querySelector('.help-block');
    
    if (!errorMsg) {
        errorMsg = document.createElement('span');
        errorMsg.className = 'help-block';
        errorMsg.style.color = '#f44336';
        errorContainer.appendChild(errorMsg);
    }
    
    errorMsg.textContent = message;
}

function clearFieldError(field) {
    const errorMsg = field.parentElement.querySelector('.help-block');
    if (errorMsg) {
        errorMsg.textContent = '';
    }
}

/* ====== Tooltips ====== */
function initializeTooltips() {
    document.querySelectorAll('[data-toggle="tooltip"]').forEach(element => {
        element.addEventListener('mouseenter', function() {
            const title = this.getAttribute('data-original-title') || this.title;
            if (title) {
                const tooltip = document.createElement('div');
                tooltip.className = 'tooltip-box';
                tooltip.textContent = title;
                tooltip.style.cssText = `
                    position: absolute;
                    background: #333;
                    color: white;
                    padding: 8px 12px;
                    border-radius: 4px;
                    font-size: 12px;
                    white-space: nowrap;
                    z-index: 9999;
                    margin-top: -30px;
                    pointer-events: none;
                `;
                
                document.body.appendChild(tooltip);
                
                const rect = this.getBoundingClientRect();
                tooltip.style.left = (rect.left + rect.width / 2 - tooltip.offsetWidth / 2) + 'px';
                tooltip.style.top = (rect.top - 10) + 'px';
            }
        });

        element.addEventListener('mouseleave', function() {
            const tooltip = document.querySelector('.tooltip-box');
            if (tooltip) tooltip.remove();
        });
    });
}

/* ====== Notifications ====== */
function showNotification(message, type = 'info', duration = 3000) {
    const alertClass = `alert alert-${type}`;
    const iconMap = {
        'success': 'fa-check-circle',
        'danger': 'fa-times-circle',
        'warning': 'fa-exclamation-circle',
        'info': 'fa-info-circle'
    };

    const alertHTML = `
        <div class="${alertClass} animate-fade-in" style="margin-bottom: 20px;">
            <i class="fa ${iconMap[type]}"></i>
            <span>${message}</span>
            <button type="button" class="close" data-dismiss="alert">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    `;

    const alertContainer = document.querySelector('.container') || document.body;
    const tempDiv = document.createElement('div');
    tempDiv.innerHTML = alertHTML;
    const alertEl = tempDiv.firstElementChild;
    
    alertContainer.insertBefore(alertEl, alertContainer.firstChild);

    // Add close button functionality
    alertEl.querySelector('.close').addEventListener('click', function() {
        alertEl.remove();
    });

    // Auto-remove after duration
    if (duration > 0) {
        setTimeout(() => {
            if (alertEl.parentNode) {
                alertEl.style.animation = 'fadeOut 0.5s ease';
                setTimeout(() => alertEl.remove(), 500);
            }
        }, duration);
    }
}

/* ====== Utility Functions ====== */
function debounce(func, delay) {
    let timeoutId;
    return function(...args) {
        clearTimeout(timeoutId);
        timeoutId = setTimeout(() => func.apply(this, args), delay);
    };
}

function throttle(func, limit) {
    let inThrottle;
    return function(...args) {
        if (!inThrottle) {
            func.apply(this, args);
            inThrottle = true;
            setTimeout(() => inThrottle = false, limit);
        }
    };
}

/* ====== Export Functions ====== */
window.showNotification = showNotification;
window.debounce = debounce;
window.throttle = throttle;
