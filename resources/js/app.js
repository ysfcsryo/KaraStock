import "./bootstrap";
// ========================
// GLOBAL INTERACTIVE FEATURES
// ========================

// Smooth scroll behavior
document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
    anchor.addEventListener("click", function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute("href"));
        if (target) {
            target.scrollIntoView({ behavior: "smooth" });
        }
    });
});

// Animate elements on scroll
const observerOptions = {
    threshold: 0.1,
    rootMargin: "0px 0px -100px 0px",
};

const observer = new IntersectionObserver(function (entries) {
    entries.forEach((entry) => {
        if (entry.isIntersecting) {
            entry.target.style.opacity = "1";
            entry.target.style.transform = "translateY(0)";
        }
    });
}, observerOptions);

document
    .querySelectorAll(".card-interactive, .stat-card, .tree-node")
    .forEach((el) => {
        el.style.opacity = "0";
        el.style.transform = "translateY(20px)";
        el.style.transition = "all 0.6s ease";
        observer.observe(el);
    });

// Loading state for forms
document.querySelectorAll("form").forEach((form) => {
    form.addEventListener("submit", function () {
        const submitBtn = this.querySelector('button[type="submit"]');
        if (submitBtn) {
            const originalHTML = submitBtn.innerHTML;
            submitBtn.disabled = true;
            submitBtn.innerHTML =
                '<span class="spinner-border spinner-border-sm me-2"></span>Processing...';

            // Reset after 5 seconds if not submitted
            setTimeout(() => {
                if (submitBtn.disabled) {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalHTML;
                }
            }, 5000);
        }
    });
});

// Active menu highlight based on current URL
document.querySelectorAll(".list-group-item").forEach((item) => {
    if (item.href === window.location.href) {
        item.classList.add("active");
    }
});

// Tooltip initialization (Bootstrap)
document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach((el) => {
    new bootstrap.Tooltip(el);
});

// Toast notifications
document.querySelectorAll(".alert").forEach((alert) => {
    if (
        alert.classList.contains("alert-success") ||
        alert.classList.contains("alert-danger")
    ) {
        const alertInstance = new bootstrap.Alert(alert);
        setTimeout(() => {
            if (!alert.classList.contains("alert-danger")) {
                alertInstance.close();
            }
        }, 5000);
    }
});

// Copy to clipboard functionality
document.querySelectorAll("[data-copy]").forEach((el) => {
    el.addEventListener("click", function () {
        const text = this.getAttribute("data-copy");
        navigator.clipboard.writeText(text).then(() => {
            const originalText = this.innerHTML;
            this.innerHTML = '<i class="bi bi-check"></i> Copied!';
            setTimeout(() => {
                this.innerHTML = originalText;
            }, 2000);
        });
    });
});

console.log("✓ KaraStock - Interactive Features Loaded");
