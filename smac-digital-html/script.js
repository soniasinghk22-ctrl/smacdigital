(function () {
  var root = document.documentElement;
  root.classList.add("js");

  var header = document.querySelector("[data-header]");
  var nav = document.querySelector("[data-nav]");
  var navToggle = document.querySelector("[data-nav-toggle]");
  var megaToggle = document.querySelector("[data-mega-toggle]");
  var megaParent = megaToggle ? megaToggle.closest(".has-mega") : null;
  var dropParents = Array.prototype.slice.call(document.querySelectorAll(".has-drop"));

  function onScroll() {
    if (!header) return;
    header.classList.toggle("is-stuck", window.scrollY > 8);
  }

  onScroll();
  window.addEventListener("scroll", onScroll, { passive: true });

  function closeNav() {
    if (!nav || !navToggle) return;
    nav.classList.remove("is-open");
    navToggle.setAttribute("aria-expanded", "false");
    document.body.style.overflow = "";
  }

  function openNav() {
    nav.classList.add("is-open");
    navToggle.setAttribute("aria-expanded", "true");
    document.body.style.overflow = "hidden";
  }

  if (navToggle && nav) {
    navToggle.addEventListener("click", function () {
      if (nav.classList.contains("is-open")) closeNav();
      else openNav();
    });

    nav.querySelectorAll("a").forEach(function (link) {
      link.addEventListener("click", function () {
        if (window.matchMedia("(max-width: 980px)").matches) closeNav();
      });
    });
  }

  function desktopNav() {
    return window.matchMedia("(min-width: 981px)").matches;
  }

  function closeAllDrops(except) {
    dropParents.forEach(function (parent) {
      if (except && parent === except) return;
      parent.classList.remove("is-open");
      var btn = parent.querySelector("[data-drop-toggle]");
      if (btn) btn.setAttribute("aria-expanded", "false");
    });
  }

  function closeMega() {
    if (!megaParent) return;
    megaParent.classList.remove("is-open");
    if (megaToggle) megaToggle.setAttribute("aria-expanded", "false");
  }

  if (megaToggle && megaParent) {
    var megaPanel = document.getElementById("services-menu");
    var closeTimer = null;

    function openMega() {
      clearTimeout(closeTimer);
      closeAllDrops();
      megaParent.classList.add("is-open");
      megaToggle.setAttribute("aria-expanded", "true");
    }

    function scheduleCloseMega() {
      if (!desktopNav()) return;
      clearTimeout(closeTimer);
      closeTimer = setTimeout(closeMega, 280);
    }

    megaParent.addEventListener("mouseenter", function () {
      if (desktopNav()) openMega();
    });
    megaParent.addEventListener("mouseleave", scheduleCloseMega);
    if (megaPanel) {
      megaPanel.addEventListener("mouseenter", function () {
        if (desktopNav()) openMega();
      });
      megaPanel.addEventListener("mouseleave", scheduleCloseMega);
    }

    megaToggle.addEventListener("click", function (event) {
      event.stopPropagation();
      if (desktopNav()) {
        openMega();
        return;
      }
      closeAllDrops();
      var open = megaParent.classList.toggle("is-open");
      megaToggle.setAttribute("aria-expanded", open ? "true" : "false");
    });
  }

  dropParents.forEach(function (parent) {
    var toggle = parent.querySelector("[data-drop-toggle]");
    var panel = parent.querySelector(".drop");
    var dropTimer = null;
    if (!toggle || !panel) return;

    function openDrop() {
      clearTimeout(dropTimer);
      closeMega();
      closeAllDrops(parent);
      parent.classList.add("is-open");
      toggle.setAttribute("aria-expanded", "true");
    }

    function closeDrop() {
      clearTimeout(dropTimer);
      parent.classList.remove("is-open");
      toggle.setAttribute("aria-expanded", "false");
    }

    function scheduleCloseDrop() {
      if (!desktopNav()) return;
      clearTimeout(dropTimer);
      dropTimer = setTimeout(closeDrop, 280);
    }

    parent.addEventListener("mouseenter", function () {
      if (desktopNav()) openDrop();
    });
    parent.addEventListener("mouseleave", scheduleCloseDrop);
    panel.addEventListener("mouseenter", function () {
      if (desktopNav()) openDrop();
    });
    panel.addEventListener("mouseleave", scheduleCloseDrop);

    toggle.addEventListener("click", function (event) {
      event.stopPropagation();
      if (desktopNav()) {
        openDrop();
        return;
      }
      var open = !parent.classList.contains("is-open");
      closeMega();
      closeAllDrops();
      if (open) {
        parent.classList.add("is-open");
        toggle.setAttribute("aria-expanded", "true");
      }
    });
  });

  document.addEventListener("click", function (event) {
    if (megaParent && !megaParent.contains(event.target)) closeMega();
    dropParents.forEach(function (parent) {
      if (!parent.contains(event.target)) {
        parent.classList.remove("is-open");
        var btn = parent.querySelector("[data-drop-toggle]");
        if (btn) btn.setAttribute("aria-expanded", "false");
      }
    });
  });

  document.addEventListener("keydown", function (event) {
    if (event.key !== "Escape") return;
    if (nav && nav.classList.contains("is-open")) {
      closeNav();
      navToggle.focus();
    }
    closeMega();
    closeAllDrops();
  });

  var sections = ["about", "services", "work", "case-studies", "insights", "contact"]
    .map(function (id) { return document.getElementById(id); })
    .filter(Boolean);

  var navLinks = Array.prototype.slice.call(document.querySelectorAll("[data-nav-link]"));

  function setCurrent(id) {
    navLinks.forEach(function (link) {
      var href = link.getAttribute("href") || "";
      var match = href === "#" + id || (id === "top" && href === "#top");
      if (match) link.setAttribute("aria-current", "true");
      else link.removeAttribute("aria-current");
    });
  }

  if ("IntersectionObserver" in window && sections.length) {
    var sectionObserver = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) setCurrent(entry.target.id);
      });
    }, { rootMargin: "-45% 0px -45% 0px", threshold: 0.01 });

    sections.forEach(function (section) { sectionObserver.observe(section); });
  }

  var carousel = document.querySelector("[data-carousel]");
  if (carousel) {
    var slides = Array.prototype.slice.call(carousel.querySelectorAll("[data-slide]"));
    var prev = carousel.querySelector("[data-carousel-prev]");
    var next = carousel.querySelector("[data-carousel-next]");
    var dotsWrap = carousel.querySelector(".carousel-dots");
    var index = 0;

    function render(nextIndex) {
      index = (nextIndex + slides.length) % slides.length;
      slides.forEach(function (slide, i) {
        var active = i === index;
        slide.classList.toggle("is-active", active);
        slide.hidden = !active;
      });
      Array.prototype.forEach.call(dotsWrap.children, function (dot, i) {
        dot.setAttribute("aria-selected", i === index ? "true" : "false");
        dot.tabIndex = i === index ? 0 : -1;
      });
    }

    slides.forEach(function (slide, i) {
      var dot = document.createElement("button");
      dot.type = "button";
      dot.setAttribute("role", "tab");
      dot.setAttribute("aria-label", "Testimonial " + (i + 1) + " of " + slides.length);
      dot.addEventListener("click", function () { render(i); });
      dotsWrap.appendChild(dot);
    });

    if (prev) prev.addEventListener("click", function () { render(index - 1); });
    if (next) next.addEventListener("click", function () { render(index + 1); });

    carousel.addEventListener("keydown", function (event) {
      if (event.key === "ArrowRight") {
        render(index + 1);
        event.preventDefault();
      }
      if (event.key === "ArrowLeft") {
        render(index - 1);
        event.preventDefault();
      }
    });

    render(0);
  }

  var reduceMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
  var desktopTyping = window.matchMedia("(min-width: 981px)").matches;

  function typeHeroTitle() {
    var title = document.querySelector("[data-hero-type]");
    if (!title || reduceMotion || !desktopTyping) return;

    var lines = Array.prototype.slice.call(title.querySelectorAll("[data-type]"));
    if (!lines.length) return;

    title.classList.add("is-typing");
    lines.forEach(function (line) {
      line.textContent = "";
    });

    var lineIndex = 0;
    var charIndex = 0;
    var delay = 58;

    function tick() {
      var line = lines[lineIndex];
      var full = line.getAttribute("data-type") || "";
      lines.forEach(function (item) { item.classList.remove("is-active"); });
      line.classList.add("is-active");
      charIndex += 1;
      line.textContent = full.slice(0, charIndex);

      if (charIndex < full.length) {
        window.setTimeout(tick, delay);
        return;
      }

      line.classList.remove("is-active");
      lineIndex += 1;
      charIndex = 0;

      if (lineIndex < lines.length) {
        window.setTimeout(tick, 280);
        return;
      }

      title.classList.remove("is-typing");
    }

    window.setTimeout(tick, 350);
  }

  typeHeroTitle();

  var counters = Array.prototype.slice.call(document.querySelectorAll("[data-count]"));

  function formatCount(value) {
    return value.toLocaleString("en-IN");
  }

  function runCount(el) {
    var target = parseInt(el.getAttribute("data-count"), 10);
    var suffix = el.getAttribute("data-suffix") || "";
    if (reduceMotion || !target) {
      el.textContent = formatCount(target) + suffix;
      return;
    }
    var start = performance.now();
    var duration = 900;
    function tick(now) {
      var progress = Math.min(1, (now - start) / duration);
      var eased = 1 - Math.pow(1 - progress, 3);
      el.textContent = formatCount(Math.round(target * eased)) + suffix;
      if (progress < 1) requestAnimationFrame(tick);
    }
    requestAnimationFrame(tick);
  }

  if ("IntersectionObserver" in window && counters.length) {
    var countObserver = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (!entry.isIntersecting) return;
        runCount(entry.target);
        countObserver.unobserve(entry.target);
      });
    }, { threshold: 0.5 });
    counters.forEach(function (el) { countObserver.observe(el); });
  }

  var revealNodes = document.querySelectorAll(".hero-copy, .section-head, .services-top, .about-head, .about-pillar, .svc-row, .stat, .case-card, .blog-head, .blog-featured, .blog-item, .work-card, .say-intro, .say-item, .contact-copy, .contact-studio-copy, .contact-place, .lead-form, .contact-card, .partners-head, .partner-cell");
  revealNodes.forEach(function (node) {
    if (!node.classList.contains("svc-row") && !node.classList.contains("about-pillar")) node.classList.add("reveal");
  });

  var mediaRevealNodes = Array.prototype.slice.call(
    document.querySelectorAll([
      ".svc-intro-media",
      ".svc-long-panel--media",
      ".svc-row-media",
      ".page-hero-media",
      ".page-project-media",
      ".page-service-card",
      ".about-vm-media",
      ".case-card-media",
      ".blog-featured",
      ".work-panel-media",
      ".seo-lp-roi-media",
      ".seo-lp-chosen-media",
      ".seo-lp-reason-grid .seo-lp-card",
      ".seo-lp-process-grid .seo-lp-card",
      ".seo-lp-why-grid .seo-lp-card",
      ".seo-lp-bring .seo-lp-card",
      ".seo-lp-offer .seo-lp-card",
      ".blog-detail-cover",
      ".page-blog-card-media"
    ].join(", "))
  );
  document.querySelectorAll(".svc-related a").forEach(function (link) {
    if (link.querySelector(".svc-related-media")) mediaRevealNodes.push(link);
  });
  document.querySelectorAll(".blog-item").forEach(function (item) {
    if (item.querySelector("img")) mediaRevealNodes.push(item);
  });
  var skipMediaRevealAnim = window.matchMedia("(max-width: 980px)").matches;

  mediaRevealNodes.forEach(function (node) {
    if (skipMediaRevealAnim) {
      node.classList.add("is-in");
      return;
    }
    node.classList.add("media-reveal");
  });

  function showMediaReveal(node) {
    if (!node || node.classList.contains("is-in")) return;
    node.classList.add("is-in");
  }

  function mediaInView(node) {
    var rect = node.getBoundingClientRect();
    var vh = window.innerHeight || document.documentElement.clientHeight;
    return rect.top < vh * 0.92 && rect.bottom > 40;
  }

  if ("IntersectionObserver" in window && !reduceMotion) {
    var revealObserver = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (!entry.isIntersecting) return;
        entry.target.classList.add("is-in");
        revealObserver.unobserve(entry.target);
      });
    }, { threshold: 0.14 });
    revealNodes.forEach(function (node) { revealObserver.observe(node); });

    if (!skipMediaRevealAnim) {
      var mediaRevealObserver = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
          if (!entry.isIntersecting) return;
          showMediaReveal(entry.target);
          mediaRevealObserver.unobserve(entry.target);
        });
      }, { threshold: 0.1, rootMargin: "40px 0px -5% 0px" });
      mediaRevealNodes.forEach(function (node) { mediaRevealObserver.observe(node); });

      function sweepMediaReveals() {
        mediaRevealNodes.forEach(function (node) {
          if (node.classList.contains("is-in")) return;
          if (!mediaInView(node)) return;
          showMediaReveal(node);
          try { mediaRevealObserver.unobserve(node); } catch (e) {}
        });
      }

      requestAnimationFrame(sweepMediaReveals);
      window.addEventListener("scroll", sweepMediaReveals, { passive: true });
      window.addEventListener("load", sweepMediaReveals);
    }
  } else {
    revealNodes.forEach(function (node) { node.classList.add("is-in"); });
    mediaRevealNodes.forEach(function (node) { showMediaReveal(node); });
  }

  var workShowcase = document.querySelector("[data-work-showcase]");
  if (workShowcase) {
    var workTabs = Array.prototype.slice.call(workShowcase.querySelectorAll("[data-work-tab]"));
    var workSlides = Array.prototype.slice.call(workShowcase.querySelectorAll("[data-work-slide]"));
    var workTrack = workShowcase.querySelector(".work-tabs-track");
    var workViewport = workShowcase.querySelector("[data-work-tabs]");
    var workPrev = workShowcase.querySelector("[data-work-prev]");
    var workNext = workShowcase.querySelector("[data-work-next]");
    var workIndex = 0;
    var workOffset = 0;
    var workTimer = null;
    var workPaused = false;

    function setWorkOffset(nextX) {
      if (!workTrack || !workViewport) return;
      var maxX = Math.max(0, workTrack.scrollWidth - workViewport.clientWidth);
      workOffset = Math.max(0, Math.min(nextX, maxX));
      workTrack.style.transform = "translate3d(" + (-workOffset) + "px,0,0)";
    }

    function scrollWorkTabIntoView(index) {
      if (!workTrack || !workViewport || !workTabs[index]) return;
      var tab = workTabs[index];
      var tabLeft = tab.offsetLeft;
      var tabRight = tabLeft + tab.offsetWidth;
      var viewWidth = workViewport.clientWidth;
      var nextX = workOffset;
      if (tabLeft < workOffset + 12) nextX = Math.max(0, tabLeft - 12);
      else if (tabRight > workOffset + viewWidth - 12) nextX = tabRight - viewWidth + 12;
      setWorkOffset(nextX);
    }

    function showWork(index) {
      if (!workTabs.length) return;
      workIndex = (index + workTabs.length) % workTabs.length;
      workTabs.forEach(function (tab, i) {
        var on = i === workIndex;
        tab.classList.toggle("is-active", on);
        tab.setAttribute("aria-selected", on ? "true" : "false");
      });
      workSlides.forEach(function (slide, i) {
        var on = i === workIndex;
        slide.classList.toggle("is-active", on);
        slide.hidden = !on;
      });
      scrollWorkTabIntoView(workIndex);
    }

    function stopWorkAuto() {
      if (workTimer) {
        clearInterval(workTimer);
        workTimer = null;
      }
    }

    function startWorkAuto() {
      stopWorkAuto();
      if (reduceMotion || workPaused || workTabs.length < 2) return;
      workTimer = setInterval(function () {
        showWork(workIndex + 1);
      }, 5500);
    }

    function userWorkAction(index) {
      showWork(index);
      stopWorkAuto();
      startWorkAuto();
    }

    workTabs.forEach(function (tab) {
      tab.addEventListener("pointerdown", function (event) {
        event.stopPropagation();
      });
      tab.addEventListener("click", function (event) {
        event.preventDefault();
        userWorkAction(Number(tab.getAttribute("data-work-tab")) || 0);
      });
    });
    if (workPrev) {
      workPrev.addEventListener("click", function () { userWorkAction(workIndex - 1); });
    }
    if (workNext) {
      workNext.addEventListener("click", function () { userWorkAction(workIndex + 1); });
    }

    if (workViewport && workTrack && !reduceMotion) {
      var drag = { ready: false, moving: false, startX: 0, origin: 0, pointerId: null };
      workViewport.addEventListener("pointerdown", function (event) {
        if (event.button && event.button !== 0) return;
        drag.ready = true;
        drag.moving = false;
        drag.startX = event.clientX;
        drag.origin = workOffset;
        drag.pointerId = event.pointerId;
      });
      workViewport.addEventListener("pointermove", function (event) {
        if (!drag.ready) return;
        var dx = event.clientX - drag.startX;
        if (!drag.moving && Math.abs(dx) < 8) return;
        if (!drag.moving) {
          drag.moving = true;
          workViewport.setPointerCapture(drag.pointerId);
          workTrack.style.transition = "none";
          stopWorkAuto();
        }
        setWorkOffset(drag.origin - dx);
      });
      function endDrag() {
        if (!drag.ready) return;
        drag.ready = false;
        if (drag.moving) {
          workTrack.style.transition = "";
          startWorkAuto();
        }
        drag.moving = false;
      }
      workViewport.addEventListener("pointerup", endDrag);
      workViewport.addEventListener("pointercancel", endDrag);
    }

    workShowcase.addEventListener("mouseenter", function () {
      workPaused = true;
      stopWorkAuto();
    });
    workShowcase.addEventListener("mouseleave", function () {
      workPaused = false;
      startWorkAuto();
    });

    showWork(0);
    startWorkAuto();
  }

  function initModernDropdown(dropdownEl, form) {
    if (!dropdownEl || dropdownEl.dataset.dropdownInit) return;
    dropdownEl.dataset.dropdownInit = "true";

    var trigger = dropdownEl.querySelector(".dropdown-trigger");
    var triggerText = dropdownEl.querySelector(".dropdown-trigger-text");
    var panel = dropdownEl.querySelector(".dropdown-panel");
    var checkboxes = dropdownEl.querySelectorAll('input[type="checkbox"]');
    var clearBtn = dropdownEl.querySelector("[data-clear-services]");
    var defaultPlaceholder = (triggerText && triggerText.getAttribute("data-placeholder")) || "Select services of interest...";

    function updateTriggerDisplay() {
      if (!triggerText) return;
      var checkedBoxes = Array.prototype.filter.call(checkboxes, function (cb) {
        return cb.checked;
      });

      if (checkedBoxes.length === 0) {
        triggerText.innerHTML = defaultPlaceholder;
        triggerText.classList.remove("has-selection");
        dropdownEl.classList.remove("has-selection");
      } else {
        var chips = [];
        var maxChips = 2;
        for (var i = 0; i < Math.min(checkedBoxes.length, maxChips); i++) {
          var val = checkedBoxes[i].value;
          chips.push('<span class="dropdown-tag">' + val + '</span>');
        }
        if (checkedBoxes.length > maxChips) {
          var extra = checkedBoxes.length - maxChips;
          chips.push('<span class="dropdown-badge">+' + extra + ' more</span>');
        }
        triggerText.innerHTML = chips.join(" ");
        triggerText.classList.add("has-selection");
        dropdownEl.classList.add("has-selection");
      }

      var container = dropdownEl.closest(".field, .field-dropdown");
      if (container && checkedBoxes.length > 0) {
        container.classList.remove("is-invalid");
        var err = container.querySelector(".field-error");
        if (err) {
          err.hidden = true;
          err.textContent = "";
        }
      }
    }

    if (trigger) {
      trigger.addEventListener("click", function (e) {
        e.preventDefault();
        e.stopPropagation();
        var isOpen = dropdownEl.classList.toggle("is-active");
        trigger.setAttribute("aria-expanded", isOpen ? "true" : "false");
      });
    }

    checkboxes.forEach(function (cb) {
      cb.addEventListener("change", function () {
        updateTriggerDisplay();
      });
    });

    if (clearBtn) {
      clearBtn.addEventListener("click", function (e) {
        e.preventDefault();
        e.stopPropagation();
        checkboxes.forEach(function (cb) {
          cb.checked = false;
        });
        updateTriggerDisplay();
      });
    }

    if (panel) {
      panel.addEventListener("click", function (e) {
        e.stopPropagation();
      });
    }

    document.addEventListener("click", function (e) {
      if (!dropdownEl.contains(e.target)) {
        dropdownEl.classList.remove("is-active");
        if (trigger) trigger.setAttribute("aria-expanded", "false");
      }
    });

    dropdownEl._resetDropdown = function () {
      checkboxes.forEach(function (cb) {
        cb.checked = false;
      });
      updateTriggerDisplay();
    };

    updateTriggerDisplay();
  }

  function setupLeadForm(form) {
    if (!form || form.dataset.leadInit) return;
    form.dataset.leadInit = "true";

    var multiselect = form.querySelector("[data-multiselect]");
    if (multiselect) {
      initModernDropdown(multiselect, form);
    }

    var status = form.querySelector(".form-status") || document.getElementById(form.id + "-status");
    var params = new URLSearchParams(window.location.search);
    ["utm_source", "utm_medium", "utm_campaign", "utm_term", "utm_content", "utm_id", "gclid", "fbclid"].forEach(function (key) {
      var input = form.querySelector('[name="' + key + '"]');
      if (input) input.value = params.get(key) || "";
    });
    var landing = form.querySelector('[name="landing_url"]');
    var referrer = form.querySelector('[name="referrer_url"]');
    if (landing) landing.value = window.location.href;
    if (referrer) referrer.value = document.referrer || "";

    function setError(fieldName, message) {
      var fieldEl = form.querySelector('[name="' + fieldName + '"]');
      var container = null;
      if (fieldName === "service") {
        container = form.querySelector(".field-dropdown, .field-services");
      } else if (fieldEl) {
        container = fieldEl.closest(".field");
      }
      var errorEl = container ? container.querySelector(".field-error") : null;
      if (errorEl) {
        errorEl.hidden = !message;
        errorEl.textContent = message || "";
      }
      if (fieldEl) fieldEl.setAttribute("aria-invalid", message ? "true" : "false");
      if (container) container.classList.toggle("is-invalid", Boolean(message));
    }

    function clearAllErrors() {
      form.querySelectorAll(".field, .field-dropdown, .field-services").forEach(function (f) {
        f.classList.remove("is-invalid");
      });
      form.querySelectorAll(".field-error").forEach(function (e) {
        e.hidden = true;
        e.textContent = "";
      });
      form.querySelectorAll("[aria-invalid]").forEach(function (i) {
        i.setAttribute("aria-invalid", "false");
      });
    }

    form.querySelectorAll("input, textarea").forEach(function (input) {
      input.addEventListener("input", function () {
        var container = input.closest(".field, .field-dropdown");
        if (container && container.classList.contains("is-invalid")) {
          container.classList.remove("is-invalid");
          var err = container.querySelector(".field-error");
          if (err) {
            err.hidden = true;
            err.textContent = "";
          }
        }
      });
      if (input.type === "checkbox") {
        input.addEventListener("change", function () {
          var container = input.closest(".field-dropdown, .field-services");
          if (container && container.classList.contains("is-invalid")) {
            container.classList.remove("is-invalid");
            var err = container.querySelector(".field-error");
            if (err) {
              err.hidden = true;
              err.textContent = "";
            }
          }
        });
      }
    });

    function validate() {
      var valid = true;
      var nameInput = form.querySelector('[name="name"]');
      var emailInput = form.querySelector('[name="email"]');
      var phoneInput = form.querySelector('[name="phone"]');
      var messageInput = form.querySelector('[name="message"]');

      var name = nameInput ? nameInput.value.trim() : "";
      var email = emailInput ? emailInput.value.trim() : "";
      var phone = phoneInput ? phoneInput.value.trim() : "";
      var message = messageInput ? messageInput.value.trim() : "";
      var services = form.querySelectorAll('input[name="service"]:checked');

      clearAllErrors();

      if (name.length < 2) {
        setError("name", "Enter your full name.");
        valid = false;
      }
      if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
        setError("email", "Enter a valid business email.");
        valid = false;
      }
      if (!/^\d{10}$/.test(phone)) {
        setError("phone", "Enter a 10-digit phone number.");
        valid = false;
      }
      if (!services.length) {
        setError("service", "Choose at least one service.");
        valid = false;
      }
      if (message.length < 10) {
        setError("message", "Add a short note about the project requirements.");
        valid = false;
      }
      return valid;
    }

    form.addEventListener("submit", function (event) {
      event.preventDefault();
      if (status) {
        status.textContent = "";
        status.className = "form-status";
      }
      if (!validate()) {
        var firstInvalid = form.querySelector('[aria-invalid="true"], .is-invalid input, .is-invalid textarea, .field-dropdown.is-invalid .dropdown-trigger');
        if (firstInvalid && firstInvalid.focus) firstInvalid.focus();
        return;
      }

      var button = form.querySelector("[data-submit]");
      var data = new FormData(form);
      var chosen = [];
      form.querySelectorAll('input[name="service"]:checked').forEach(function (box) {
        chosen.push(box.value);
      });
      data.delete("service");
      data.set("service", chosen.join(", "));

      if (button) button.disabled = true;
      var label = button ? button.querySelector("span:not(.lead-submit-arrow)") : null;
      var original = label ? label.textContent : (button ? button.textContent : "");
      if (label) label.textContent = "Sending…";
      else if (button) button.textContent = "Sending…";

      var targetUrl = form.action;
      if (window.location.hostname === "127.0.0.1" || window.location.hostname === "localhost") {
        targetUrl = "/save-lead";
      }
      fetch(targetUrl, {
        method: "POST",
        body: data,
        headers: { "Accept": "application/json, text/html" },
        credentials: "include"
      }).then(function (response) {
        if (response.ok) {
          form.reset();
          if (multiselect && typeof multiselect._resetDropdown === "function") {
            multiselect._resetDropdown();
          }
          if (status) {
            status.className = "form-status is-success";
            status.textContent = "Request received! The SMAC Digital team has your brief and will reply shortly.";
          }
        } else {
          if (status) {
            status.className = "form-status is-error";
            status.textContent = "The server did not accept this request (status " + response.status + "). Please call +91 95827 92638 or reach out via WhatsApp.";
          }
        }
      }).catch(function () {
        if (status) {
          status.className = "form-status is-error";
          status.textContent = "Request could not be delivered. Please call +91 95827 92638 or reach out via WhatsApp.";
        }
      }).then(function () {
        if (button) button.disabled = false;
        if (label) label.textContent = original;
        else if (button) button.textContent = original;
      });
    });
  }

  // Initialize any static lead form on page
  var onPageLeadForm = document.getElementById("lead-form");
  if (onPageLeadForm) {
    setupLeadForm(onPageLeadForm);
  }

  // ==========================================================================
  // Lead Brief Modal Management
  // ==========================================================================

  var modalHtmlTemplate = [
    '<div class="lead-modal" id="lead-modal" role="dialog" aria-modal="true" aria-labelledby="modal-form-title" hidden>',
    '  <div class="lead-modal-backdrop" data-modal-close></div>',
    '  <div class="lead-modal-card">',
    '    <div class="lead-modal-head">',
    '      <button class="lead-modal-close" type="button" data-modal-close aria-label="Close brief modal">',
    '        <svg viewBox="0 0 24 24" width="18" height="18" aria-hidden="true" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">',
    '          <line x1="18" y1="6" x2="6" y2="18"></line>',
    '          <line x1="6" y1="6" x2="18" y2="18"></line>',
    '        </svg>',
    '      </button>',
    '      <p class="lead-form-kicker">START A BRIEF</p>',
    '      <h3 class="lead-form-title" id="modal-form-title">Share a few details. We’ll reply with a clear next step.</h3>',
    '    </div>',
    '    <form class="modal-lead-form" id="modal-lead-form" method="post" action="https://www.smacdigital.com/save-lead" novalidate>',
    '      <input type="hidden" name="landing_url" value="">',
    '      <input type="hidden" name="referrer_url" value="">',
    '      <input type="hidden" name="utm_source" value="">',
    '      <input type="hidden" name="utm_medium" value="">',
    '      <input type="hidden" name="utm_campaign" value="">',
    '      <input type="hidden" name="utm_term" value="">',
    '      <input type="hidden" name="utm_content" value="">',
    '      <input type="hidden" name="utm_id" value="">',
    '      <input type="hidden" name="gclid" value="">',
    '      <input type="hidden" name="fbclid" value="">',
    '      <div class="field-row">',
    '        <div class="field field-float">',
    '          <input id="modal-name" name="name" type="text" autocomplete="name" placeholder=" " required>',
    '          <label for="modal-name">Full name</label>',
    '          <p class="field-error" id="modal-name-error" hidden></p>',
    '        </div>',
    '        <div class="field field-float">',
    '          <input id="modal-email" name="email" type="email" autocomplete="email" placeholder=" " required>',
    '          <label for="modal-email">Business email</label>',
    '          <p class="field-error" id="modal-email-error" hidden></p>',
    '        </div>',
    '      </div>',
    '      <div class="field-row">',
    '        <div class="field field-float">',
    '          <input id="modal-phone" name="phone" type="tel" inputmode="numeric" autocomplete="tel" maxlength="10" placeholder=" " required>',
    '          <label for="modal-phone">Phone number</label>',
    '          <p class="field-error" id="modal-phone-error" hidden></p>',
    '        </div>',
    '        <div class="field field-float">',
    '          <input id="modal-company" name="company" type="text" autocomplete="organization" placeholder=" ">',
    '          <label for="modal-company">Company or website</label>',
    '          <p class="field-error" id="modal-company-error" hidden></p>',
    '        </div>',
    '      </div>',
    '      <div class="field field-dropdown" id="modal-service-field">',
    '        <label class="dropdown-label" for="services-dropdown-trigger">Services of interest</label>',
    '        <div class="modern-dropdown" data-multiselect>',
    '          <button type="button" class="dropdown-trigger" id="services-dropdown-trigger" aria-haspopup="listbox" aria-expanded="false">',
    '            <span class="dropdown-trigger-text" data-placeholder="Select services of interest...">Select services of interest...</span>',
    '            <span class="dropdown-arrow" aria-hidden="true">',
    '              <svg viewBox="0 0 20 20" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">',
    '                <polyline points="6 9 10 13 14 9"></polyline>',
    '              </svg>',
    '            </span>',
    '          </button>',
    '          <div class="dropdown-panel" role="listbox" aria-multiselectable="true">',
    '            <div class="dropdown-panel-header">',
    '              <span class="dropdown-panel-hint">Select all that apply</span>',
    '              <button type="button" class="dropdown-clear-btn" data-clear-services>Clear all</button>',
    '            </div>',
    '            <div class="dropdown-options">',
    '              <label class="dropdown-option"><input type="checkbox" name="service" value="Marketing automation"><span class="option-custom-check"><svg viewBox="0 0 16 16" width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 8.5 6.5 12 13 4"></polyline></svg></span><span class="option-text">Marketing automation</span></label>',
    '              <label class="dropdown-option"><input type="checkbox" name="service" value="Inbound"><span class="option-custom-check"><svg viewBox="0 0 16 16" width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 8.5 6.5 12 13 4"></polyline></svg></span><span class="option-text">Inbound</span></label>',
    '              <label class="dropdown-option"><input type="checkbox" name="service" value="Social media"><span class="option-custom-check"><svg viewBox="0 0 16 16" width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 8.5 6.5 12 13 4"></polyline></svg></span><span class="option-text">Social media</span></label>',
    '              <label class="dropdown-option"><input type="checkbox" name="service" value="SEO"><span class="option-custom-check"><svg viewBox="0 0 16 16" width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 8.5 6.5 12 13 4"></polyline></svg></span><span class="option-text">SEO</span></label>',
    '              <label class="dropdown-option"><input type="checkbox" name="service" value="Video"><span class="option-custom-check"><svg viewBox="0 0 16 16" width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 8.5 6.5 12 13 4"></polyline></svg></span><span class="option-text">Video</span></label>',
    '              <label class="dropdown-option"><input type="checkbox" name="service" value="Website"><span class="option-custom-check"><svg viewBox="0 0 16 16" width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 8.5 6.5 12 13 4"></polyline></svg></span><span class="option-text">Website</span></label>',
    '              <label class="dropdown-option"><input type="checkbox" name="service" value="Mobile app"><span class="option-custom-check"><svg viewBox="0 0 16 16" width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 8.5 6.5 12 13 4"></polyline></svg></span><span class="option-text">Mobile app</span></label>',
    '              <label class="dropdown-option"><input type="checkbox" name="service" value="Media planning"><span class="option-custom-check"><svg viewBox="0 0 16 16" width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 8.5 6.5 12 13 4"></polyline></svg></span><span class="option-text">Media planning</span></label>',
    '              <label class="dropdown-option"><input type="checkbox" name="service" value="Lead generation"><span class="option-custom-check"><svg viewBox="0 0 16 16" width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 8.5 6.5 12 13 4"></polyline></svg></span><span class="option-text">Lead generation</span></label>',
    '              <label class="dropdown-option"><input type="checkbox" name="service" value="Content"><span class="option-custom-check"><svg viewBox="0 0 16 16" width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 8.5 6.5 12 13 4"></polyline></svg></span><span class="option-text">Content</span></label>',
    '              <label class="dropdown-option"><input type="checkbox" name="service" value="Reputation"><span class="option-custom-check"><svg viewBox="0 0 16 16" width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 8.5 6.5 12 13 4"></polyline></svg></span><span class="option-text">Reputation</span></label>',
    '              <label class="dropdown-option"><input type="checkbox" name="service" value="Analytics"><span class="option-custom-check"><svg viewBox="0 0 16 16" width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 8.5 6.5 12 13 4"></polyline></svg></span><span class="option-text">Analytics</span></label>',
    '            </div>',
    '          </div>',
    '        </div>',
    '        <p class="field-error" id="modal-service-error" hidden></p>',
    '      </div>',
    '      <div class="field field-float field-textarea">',
    '        <textarea id="modal-requirements" name="message" rows="4" placeholder=" " required></textarea>',
    '        <label for="modal-requirements">Project requirements</label>',
    '        <p class="field-error" id="modal-requirements-error" hidden></p>',
    '      </div>',
    '      <button class="lead-submit" type="submit" data-submit>',
    '        <span>Get a free consultation</span>',
    '        <span class="lead-submit-arrow" aria-hidden="true">',
    '          <svg viewBox="0 0 24 24"><path d="M5 12h12M13 6l6 6-6 6" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round"/></svg>',
    '        </span>',
    '      </button>',
    '      <p class="form-status" id="modal-form-status" role="status" aria-live="polite"></p>',
    '    </form>',
    '  </div>',
    '</div>'
  ].join("\n");

  function getOrInjectModal() {
    var modal = document.getElementById("lead-modal");
    if (!modal) {
      var wrap = document.createElement("div");
      wrap.innerHTML = modalHtmlTemplate.trim();
      modal = wrap.firstElementChild;
      document.body.appendChild(modal);
    }
    var modalForm = modal.querySelector("#modal-lead-form");
    if (modalForm) {
      setupLeadForm(modalForm);
    }
    bindModalEvents(modal);
    return modal;
  }

  function bindModalEvents(modal) {
    if (!modal || modal.dataset.eventsBound) return;
    modal.dataset.eventsBound = "true";

    modal.querySelectorAll("[data-modal-close]").forEach(function (btn) {
      btn.addEventListener("click", function (e) {
        e.preventDefault();
        closeLeadModal();
      });
    });
  }

  function openLeadModal() {
    var modal = getOrInjectModal();
    if (!modal) return;
    modal.hidden = false;
    requestAnimationFrame(function () {
      modal.classList.add("is-open");
      document.body.classList.add("modal-open");
      var firstInput = modal.querySelector('#modal-name, input[type="text"]:not([type="hidden"])');
      if (firstInput) {
        setTimeout(function () {
          firstInput.focus();
        }, 150);
      }
    });
  }

  function closeLeadModal() {
    var modal = document.getElementById("lead-modal");
    if (!modal) return;
    modal.classList.remove("is-open");
    document.body.classList.remove("modal-open");
    setTimeout(function () {
      if (!modal.classList.contains("is-open")) {
        modal.hidden = true;
      }
    }, 300);
  }

  document.addEventListener("keydown", function (e) {
    if (e.key === "Escape" || e.keyCode === 27) {
      var modal = document.getElementById("lead-modal");
      if (modal && modal.classList.contains("is-open")) {
        closeLeadModal();
      }
    }
  });

  function ensureStickyLeftButton() {
    if (!document.querySelector(".sticky-left-cta")) {
      var btn = document.createElement("button");
      btn.type = "button";
      btn.className = "sticky-left-cta";
      btn.setAttribute("data-open-lead-modal", "");
      btn.setAttribute("aria-label", "Start A Brief - Open Modal");
      btn.innerHTML = [
        '<span class="sticky-cta-pulse" aria-hidden="true"></span>',
        '<span class="sticky-cta-icon" aria-hidden="true">',
        '  <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">',
        '    <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path>',
        '  </svg>',
        '</span>',
        '<span class="sticky-cta-label">Start A Brief</span>',
        '<span class="sticky-cta-arrow" aria-hidden="true">',
        '  <svg viewBox="0 0 20 20" width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">',
        '    <polyline points="7 4 13 10 7 16"></polyline>',
        '  </svg>',
        '</span>'
      ].join("");
      document.body.appendChild(btn);
    }
  }

  // Attach click listener to header and sticky left "Let's Talk" buttons
  function initHeaderButtons() {
    ensureStickyLeftButton();
    var talkButtons = document.querySelectorAll(
      ".site-header .nav-cta, header .nav-cta, [data-open-lead-modal], a[href*='contact.html'].nav-cta, a.nav-cta, .sticky-left-cta"
    );
    talkButtons.forEach(function (btn) {
      if (btn.dataset.modalInit) return;
      btn.dataset.modalInit = "true";
      btn.setAttribute("role", "button");
      btn.setAttribute("aria-haspopup", "dialog");
      btn.addEventListener("click", function (event) {
        event.preventDefault();
        if (typeof closeNav === "function") closeNav();
        openLeadModal();
      });
    });
  }

  initHeaderButtons();

  // If DOM content finishes later, re-bind
  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", initHeaderButtons);
  }

  // Home page auto-open after 2 seconds
  var isHomePage = (function () {
    var path = window.location.pathname.replace(/\\/g, "/");
    var segs = path.split("/").filter(Boolean);
    var last = segs.length > 0 ? segs[segs.length - 1].toLowerCase() : "";
    return last === "" || last === "index.html" || last === "sma-digital-new";
  })();

  if (isHomePage) {
    var homeTimerStarted = false;
    function startHomeModalTimer() {
      if (homeTimerStarted) return;
      homeTimerStarted = true;
      setTimeout(function () {
        var modal = document.getElementById("lead-modal");
        if (!modal || !modal.classList.contains("is-open")) {
          openLeadModal();
        }
      }, 2000);
    }

    if (document.readyState === "complete") {
      startHomeModalTimer();
    } else {
      window.addEventListener("load", startHomeModalTimer);
      // Fallback in case load takes long or already fired
      setTimeout(startHomeModalTimer, 2200);
    }
  }
})();
