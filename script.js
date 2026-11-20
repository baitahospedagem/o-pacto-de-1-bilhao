/**
 * O Pacto de 1 Bilhão — Script Oficial de Interações & CRO
 * Baseado na arquitetura de "pactobilhao-export"
 */

document.addEventListener('DOMContentLoaded', () => {
  // Inicialização segura de dataLayer
  window.dataLayer = window.dataLayer || [];

  function track(event, payload = {}) {
    window.dispatchEvent(new CustomEvent('pacto:analytics', { detail: { event, ...payload } }));
    window.dataLayer.push({ event, ...payload, timestamp: new Date().toISOString() });
  }

  // 1. Registro da visualização do Hero
  track('hero_view');

  // ==========================================================================
  // CARROSSEL / SLIDER HERO COM 2 BANNERS EDITORIAIS
  // ==========================================================================
  function initHeroSlider() {
    const hero = document.querySelector('.hero-slider');
    if (!hero) return;

    const bgSlides = Array.from(hero.querySelectorAll('.hero-slider__bg-slide'));
    const contentSlides = Array.from(hero.querySelectorAll('.hero-slide-item'));
    const dots = Array.from(hero.querySelectorAll('.hero-slider__dot'));
    const btnPrev = document.getElementById('hero-slider-prev');
    const btnNext = document.getElementById('hero-slider-next');

    if (!bgSlides.length || !contentSlides.length) return;

    let currentIndex = 0;
    const totalSlides = bgSlides.length;
    const SLIDE_DURATION = 8000; // 8 segundos por banner
    let progressStartTime = 0;
    let progressAnimId = null;
    let isPaused = false;
    let elapsedBeforePause = 0;

    // ==========================================================================
    // Máquinas de escrever editoriais (Typewriter com cursor dourado)
    // ==========================================================================

    // Slide 1: "LANÇAMENTO"
    const slideLancamentoTitleEl = document.querySelector('.hero-slide-title');
    const slideLancamentoText = 'LANÇAMENTO';
    let lancamentoTimeouts = [];

    function runLancamentoTypewriter() {
      if (!slideLancamentoTitleEl) return;
      if (window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        slideLancamentoTitleEl.textContent = slideLancamentoText;
        return;
      }

      lancamentoTimeouts.forEach(id => clearTimeout(id));
      lancamentoTimeouts = [];
      slideLancamentoTitleEl.innerHTML = '';

      const cursor = document.createElement('span');
      cursor.className = 'hero-cursor is-typing';
      cursor.setAttribute('aria-hidden', 'true');
      slideLancamentoTitleEl.appendChild(cursor);

      let elapsed = 160;
      const chars = Array.from(slideLancamentoText);

      chars.forEach((char) => {
        const pace = 56 + Math.floor(Math.random() * 24);
        elapsed += pace;

        const id = setTimeout(() => {
          const span = document.createElement('span');
          span.className = 'hero-char';
          span.textContent = char;
          slideLancamentoTitleEl.insertBefore(span, cursor);
        }, elapsed);
        lancamentoTimeouts.push(id);
      });

      const finishId = setTimeout(() => {
        cursor.classList.remove('is-typing');

        const fadeId = setTimeout(() => {
          cursor.classList.add('is-fading');
          const removeId = setTimeout(() => {
            cursor.remove();
          }, 600);
          lancamentoTimeouts.push(removeId);
        }, 1600);
        lancamentoTimeouts.push(fadeId);
      }, elapsed + 50);
      lancamentoTimeouts.push(finishId);
    }



    // Slide 2: "O Pacto de" + revelação de "1 Bilhão"
    const slidePactoTitleLine1El = document.querySelector('.hero-title-line--1');
    const slidePactoTitleLine2El = document.querySelector('.hero-title-line--2');
    const slidePactoTitleWrap = document.querySelector('.hero-title--typewriter');
    const slidePactoText = 'O Pacto de';
    let pactoTimeouts = [];

    function runPactoTypewriter() {
      if (!slidePactoTitleLine1El) return;
      if (window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        slidePactoTitleLine1El.textContent = slidePactoText;
        if (slidePactoTitleLine2El) {
          slidePactoTitleLine2El.classList.add('is-visible');
        }
        return;
      }

      pactoTimeouts.forEach(id => clearTimeout(id));
      pactoTimeouts = [];
      slidePactoTitleLine1El.innerHTML = '';

      if (slidePactoTitleLine2El) {
        slidePactoTitleLine2El.classList.remove('is-visible');
      }

      const cursor = document.createElement('span');
      cursor.className = 'hero-cursor is-typing';
      cursor.setAttribute('aria-hidden', 'true');
      slidePactoTitleLine1El.appendChild(cursor);

      let elapsed = 160;
      const chars = Array.from(slidePactoText);

      chars.forEach((char) => {
        const pace = 56 + Math.floor(Math.random() * 24);
        elapsed += pace;

        const id = setTimeout(() => {
          const span = document.createElement('span');
          if (char === ' ') {
            span.className = 'hero-char hero-char-space';
            span.innerHTML = '&nbsp;';
          } else {
            span.className = 'hero-char';
            span.textContent = char;
          }
          slidePactoTitleLine1El.insertBefore(span, cursor);
        }, elapsed);
        pactoTimeouts.push(id);
      });

      const finishId = setTimeout(() => {
        cursor.classList.remove('is-typing');

        // Revela majestosamente a linha "1 Bilhão"
        if (slidePactoTitleLine2El) {
          slidePactoTitleLine2El.classList.add('is-visible');
        }

        const fadeId = setTimeout(() => {
          cursor.classList.add('is-fading');
          const removeId = setTimeout(() => {
            cursor.remove();
          }, 600);
          pactoTimeouts.push(removeId);
        }, 1600);
        pactoTimeouts.push(fadeId);
      }, elapsed + 50);
      pactoTimeouts.push(finishId);
    }



    function activateSlide(index, restartTimer = true) {
      currentIndex = (index + totalSlides) % totalSlides;

      // 1. Atualiza backgrounds (crossfade suave)
      hero.classList.toggle('is-slide-pacto', currentIndex === 1);
      bgSlides.forEach((bg, idx) => {
        bg.classList.toggle('is-active', idx === currentIndex);
      });

      // 2. Atualiza conteúdos textuais
      contentSlides.forEach((content, idx) => {
        content.classList.toggle('is-active', idx === currentIndex);
      });

      // Dispara a animação editorial de digitação no slide ativo
      if (currentIndex === 0) {
        pactoTimeouts.forEach(id => clearTimeout(id));
        runLancamentoTypewriter();
      } else if (currentIndex === 1) {
        lancamentoTimeouts.forEach(id => clearTimeout(id));
        runPactoTypewriter();
      }

      // 3. Atualiza dots indicadores
      dots.forEach((dot, idx) => {
        const isActive = idx === currentIndex;
        dot.classList.toggle('is-active', isActive);
        dot.setAttribute('aria-selected', isActive ? 'true' : 'false');
      });

      track('hero_slide_change', { slide: currentIndex + 1 });

      if (restartTimer) {
        startProgress();
      }
    }

    function startProgress() {
      cancelAnimationFrame(progressAnimId);
      elapsedBeforePause = 0;

      // Reseta todas as barrinhas
      dots.forEach(d => {
        const bar = d.querySelector('.dot-progress');
        if (bar) bar.style.width = '0%';
      });

      const activeBar = dots[currentIndex]?.querySelector('.dot-progress');
      progressStartTime = performance.now();

      function tick(now) {
        if (!isPaused) {
          const currentElapsed = elapsedBeforePause + (now - progressStartTime);
          const percent = Math.min(100, (currentElapsed / SLIDE_DURATION) * 100);

          if (activeBar) {
            activeBar.style.width = `${percent}%`;
          }

          if (currentElapsed >= SLIDE_DURATION) {
            activateSlide(currentIndex + 1);
            return;
          }
        }
        progressAnimId = requestAnimationFrame(tick);
      }

      progressAnimId = requestAnimationFrame(tick);
    }

    function pauseProgress() {
      if (!isPaused) {
        isPaused = true;
        elapsedBeforePause += performance.now() - progressStartTime;
      }
    }

    function resumeProgress() {
      if (isPaused) {
        isPaused = false;
        progressStartTime = performance.now();
      }
    }

    // Navegação anterior e próximo
    btnPrev?.addEventListener('click', (e) => {
      e.stopPropagation();
      activateSlide(currentIndex - 1);
    });

    btnNext?.addEventListener('click', (e) => {
      e.stopPropagation();
      activateSlide(currentIndex + 1);
    });

    // Clique direto nos dots 01 e 02
    dots.forEach((dot, idx) => {
      dot.addEventListener('click', (e) => {
        e.stopPropagation();
        activateSlide(idx);
      });
    });

    // Pausar autoplay ao passar o mouse sobre o hero
    hero.addEventListener('mouseenter', pauseProgress);
    hero.addEventListener('mouseleave', resumeProgress);

    // Suporte a swipe no mobile
    let touchStartX = 0;
    hero.addEventListener('touchstart', (e) => {
      touchStartX = e.touches[0].clientX;
      pauseProgress();
    }, { passive: true });

    hero.addEventListener('touchend', (e) => {
      const touchEndX = e.changedTouches[0].clientX;
      const diff = touchEndX - touchStartX;
      if (Math.abs(diff) > 40) {
        if (diff > 0) {
          activateSlide(currentIndex - 1);
        } else {
          activateSlide(currentIndex + 1);
        }
      }
      resumeProgress();
    }, { passive: true });

    // Suporte a teclas de navegação
    document.addEventListener('keydown', (e) => {
      if (window.scrollY < window.innerHeight * 0.75) {
        if (e.key === 'ArrowLeft') activateSlide(currentIndex - 1);
        if (e.key === 'ArrowRight') activateSlide(currentIndex + 1);
      }
    });

    // ========================================================================
    // TESTE DE INTERAÇÃO: PRIMEIRO SCROLL DO MOUSE / ROLAGEM TROCA O SLIDE
    // ========================================================================
    let isScrollSwitching = false;
    let scrollSwitchCooldownTimer = null;

    function triggerScrollSwitch(targetIndex) {
      if (isScrollSwitching) return;
      isScrollSwitching = true;
      activateSlide(targetIndex);

      clearTimeout(scrollSwitchCooldownTimer);
      scrollSwitchCooldownTimer = setTimeout(() => {
        isScrollSwitching = false;
      }, 750);
    }

    // 1. Interceptação de Scroll do Mouse (wheel)
    window.addEventListener('wheel', (e) => {
      // Apenas intervém se o usuário estiver no topo da página (área do hero)
      const isAtHero = window.scrollY <= 25;

      if (isAtHero) {
        // Se estiver no Slide 1 e rolar para baixo: troca para o Slide 2
        if (e.deltaY > 10 && currentIndex === 0) {
          e.preventDefault();
          triggerScrollSwitch(1);
          return;
        }

        // Se estiver no Slide 2 e rolar para cima: volta para o Slide 1
        if (e.deltaY < -10 && currentIndex === 1) {
          e.preventDefault();
          triggerScrollSwitch(0);
          return;
        }

        // Se estiver em transição recente de scroll, consome o momentum para evitar salto brusco
        if (isScrollSwitching && e.deltaY > 0) {
          e.preventDefault();
          return;
        }
      }
    }, { passive: false });

    // 2. Interceptação de teclas de rolagem (Seta para baixo / PageDown / Espaço)
    window.addEventListener('keydown', (e) => {
      const isAtHero = window.scrollY <= 25;
      if (!isAtHero) return;

      const isInput = e.target && e.target.matches && e.target.matches('input, textarea, select, button');
      if (isInput) return;

      if ((e.key === 'ArrowDown' || e.key === 'PageDown' || e.key === ' ') && currentIndex === 0) {
        e.preventDefault();
        triggerScrollSwitch(1);
      } else if ((e.key === 'ArrowUp' || e.key === 'PageUp') && currentIndex === 1) {
        e.preventDefault();
        triggerScrollSwitch(0);
      }
    });

    // 3. Suporte ao toque vertical (Swipe vertical no mobile)
    let touchStartY = 0;
    hero.addEventListener('touchstart', (e) => {
      if (e.touches && e.touches[0]) {
        touchStartY = e.touches[0].clientY;
      }
    }, { passive: true });

    hero.addEventListener('touchmove', (e) => {
      if (window.scrollY <= 15 && currentIndex === 0 && !isScrollSwitching && e.touches && e.touches[0]) {
        const currentY = e.touches[0].clientY;
        const diffY = touchStartY - currentY;
        // Se arrastou para cima (gesto de scroll para baixo) mais de 35px:
        if (diffY > 35) {
          if (e.cancelable) e.preventDefault();
          triggerScrollSwitch(1);
        }
      }
    }, { passive: false });

    // 4. Clique no botão de rolagem "Scroll para explorar"
    const heroScrollBtn = document.querySelector('.hero-scroll');
    if (heroScrollBtn) {
      heroScrollBtn.addEventListener('click', (e) => {
        if (currentIndex === 0) {
          e.preventDefault();
          triggerScrollSwitch(1);
        }
      });
    }

    // Inicia no slide 0
    activateSlide(0);
  }

  initHeroSlider();

  // ==========================================================================
  // EFEITO DE ESCRITA CALIGRÁFICA EM TODOS OS TÍTULOS DE SEÇÃO (H2)
  // ==========================================================================
  function initAllTypewriterHeadings() {
    // Apenas títulos de seções do corpo da página (exclui o hero slide 2 para evitar linhas fantasmas)
    const headings = document.querySelectorAll('main section:not(.hero) h2');
    if (!headings.length) return;

    const isReducedMotion = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    // Função que fragmenta o texto em palavras e caracteres mantendo <br> e <em>
    function prepareHeading(heading) {
      if (heading.dataset.typewriterPrepared === 'true') return;
      heading.dataset.typewriterPrepared = 'true';

      const accessibleText = heading.textContent.replace(/\s+/g, ' ').trim();
      heading.setAttribute('aria-label', accessibleText);

      function processNode(node) {
        const fragment = document.createDocumentFragment();

        Array.from(node.childNodes).forEach(child => {
          if (child.nodeType === Node.TEXT_NODE) {
            const text = child.textContent;
            const tokens = text.split(/(\s+)/);
            tokens.forEach(token => {
              if (!token) return;
              if (/^\s+$/.test(token)) {
                const space = document.createElement('span');
                space.className = 'heading-char heading-char--space';
                space.innerHTML = '&nbsp;';
                fragment.appendChild(space);
              } else {
                const word = document.createElement('span');
                word.className = 'heading-word';
                Array.from(token).forEach(ch => {
                  const charSpan = document.createElement('span');
                  charSpan.className = 'heading-char';
                  charSpan.textContent = ch;
                  word.appendChild(charSpan);
                });
                fragment.appendChild(word);
              }
            });
          } else if (child.nodeType === Node.ELEMENT_NODE) {
            if (child.tagName.toLowerCase() === 'br') {
              fragment.appendChild(child.cloneNode(true));
            } else {
              const elementClone = child.cloneNode(false);
              elementClone.appendChild(processNode(child));
              fragment.appendChild(elementClone);
            }
          }
        });

        return fragment;
      }

      const processed = processNode(heading);
      heading.innerHTML = '';
      heading.appendChild(processed);
      heading.classList.add('typewriter-heading');
    }

    // Prepara todos os H2
    headings.forEach(h2 => prepareHeading(h2));

    // Se o usuário preferir movimento reduzido, exibe tudo imediatamente
    if (isReducedMotion) {
      headings.forEach(h2 => {
        h2.querySelectorAll('.heading-char').forEach(c => c.classList.add('is-written'));
      });
      return;
    }

    // Ativa a classe que oculta caracteres não escritos
    document.body.classList.add('typewriter-active');

    function runHeadingTypewriter(heading, isReplay = false) {
      if (heading.dataset.isTyping === 'true' && !isReplay) return;
      heading.dataset.isTyping = 'true';

      if (heading._timeouts) {
        heading._timeouts.forEach(id => clearTimeout(id));
      }
      heading._timeouts = [];

      const chars = Array.from(heading.querySelectorAll('.heading-char'));
      if (!chars.length) return;

      const oldCursor = heading.querySelector('.heading-cursor');
      if (oldCursor) oldCursor.remove();

      chars.forEach(c => c.classList.remove('is-written'));

      const cursor = document.createElement('span');
      cursor.className = 'heading-cursor is-typing';
      cursor.setAttribute('aria-hidden', 'true');

      // Posiciona o cursor no início
      chars[0].before(cursor);

      // Ritmo de escrita: ~20ms a 32ms por caractere
      let elapsed = 100;

      chars.forEach((charEl) => {
        const isSpace = charEl.classList.contains('heading-char--space');
        const pace = isSpace ? 18 : 22 + Math.floor(Math.random() * 12);
        elapsed += pace;

        const id = setTimeout(() => {
          charEl.classList.add('is-written');
          charEl.after(cursor);
        }, elapsed);
        heading._timeouts.push(id);
      });

      // Conclusão da digitação
      const finishId = setTimeout(() => {
        cursor.classList.remove('is-typing');
        heading.dataset.isTyping = 'false';
        heading.classList.add('is-finished');

        const fadeId = setTimeout(() => {
          cursor.classList.add('is-fading');
          const removeId = setTimeout(() => {
            cursor.remove();
          }, 500);
          heading._timeouts.push(removeId);
        }, 1300);
        heading._timeouts.push(fadeId);
      }, elapsed + 40);

      heading._timeouts.push(finishId);
    }



    // Disparo por IntersectionObserver ao rolar
    if (typeof IntersectionObserver !== 'undefined') {
      const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            runHeadingTypewriter(entry.target);
            observer.unobserve(entry.target);
          }
        });
      }, {
        threshold: 0.15,
        rootMargin: '0px 0px -5% 0px'
      });

      headings.forEach(h2 => observer.observe(h2));
    } else {
      headings.forEach(h2 => runHeadingTypewriter(h2));
    }
  }

  initAllTypewriterHeadings();

  // 2. Rolagem suave para a seção de compra
  function scrollToPurchase(source) {
    track('cta_click', { source });
    const purchaseEl = document.getElementById('compra') || document.getElementById('edicoes');
    if (purchaseEl) {
      purchaseEl.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
  }

  // Conectar botões de CTA à rolagem suave
  document.getElementById('btn-header-cta')?.addEventListener('click', () => scrollToPurchase('header'));
  document.getElementById('btn-hero-primary')?.addEventListener('click', () => scrollToPurchase('hero_primary'));
  document.querySelectorAll('.btn-slide-primary').forEach(btn => {
    btn.addEventListener('click', () => scrollToPurchase('hero_slide2'));
  });
  document.getElementById('btn-final-cta')?.addEventListener('click', () => scrollToPurchase('final_cta'));
  document.getElementById('btn-sticky-action')?.addEventListener('click', () => scrollToPurchase('sticky_mobile'));

  // 3. Animação de Reveal por Scroll
  // Observador Geral para seções normais (ignora os cards de edição para controle de disparo exclusivo)
  const revealTargets = Array.from(document.querySelectorAll('[data-reveal]')).filter(
    el => !el.classList.contains('edition-card')
  );
  if (typeof IntersectionObserver === 'undefined') {
    revealTargets.forEach(el => el.classList.add('is-visible'));
  } else {
    const revealObserver = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-visible');
          revealObserver.unobserve(entry.target);
        }
      });
    }, { threshold: 0.12 });

    revealTargets.forEach(el => revealObserver.observe(el));
  }

  // 3.1. Reveal Especial para os 3 Blocos de Edição (Ativa SOMENTE quando a rolagem da página chegar neles)
  const editionCards = Array.from(document.querySelectorAll('.edition-card'));
  if (editionCards.length) {
    if (typeof IntersectionObserver === 'undefined') {
      editionCards.forEach(el => el.classList.add('is-visible'));
    } else {
      const editionObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            entry.target.classList.add('is-visible');
            editionObserver.unobserve(entry.target);
          }
        });
      }, { 
        threshold: 0.18, 
        rootMargin: '0px 0px -80px 0px' 
      });

      editionCards.forEach(card => editionObserver.observe(card));
    }
  }

  // 4. Sticky CTA Mobile
  const stickyCta = document.getElementById('sticky-cta');
  const btnCloseSticky = document.getElementById('btn-close-sticky');
  let stickyDismissed = sessionStorage.getItem('pacto_sticky_dismissed') === 'true';

  function handleScroll() {
    if (stickyDismissed || window.innerWidth > 720) {
      if (stickyCta) stickyCta.style.display = 'none';
      return;
    }
    const scrolledPastHero = window.scrollY > window.innerHeight * 0.7;
    if (stickyCta) {
      stickyCta.style.display = scrolledPastHero ? 'flex' : 'none';
    }
  }

  window.addEventListener('scroll', handleScroll, { passive: true });
  window.addEventListener('resize', handleScroll);
  handleScroll();

  if (btnCloseSticky) {
    btnCloseSticky.addEventListener('click', (e) => {
      e.stopPropagation();
      stickyDismissed = true;
      sessionStorage.setItem('pacto_sticky_dismissed', 'true');
      if (stickyCta) stickyCta.style.display = 'none';
    });
  }

  // 5. Acordeão de FAQ Acessível
  const faqItems = document.querySelectorAll('.faq-item');
  faqItems.forEach((item) => {
    const btn = item.querySelector('button');
    if (!btn) return;

    btn.addEventListener('click', () => {
      const isOpen = item.classList.contains('is-open');

      // No mobile, fechar outros itens para não poluir
      if (window.innerWidth <= 720) {
        faqItems.forEach(other => {
          if (other !== item) {
            other.classList.remove('is-open');
            other.querySelector('button')?.setAttribute('aria-expanded', 'false');
            const icon = other.querySelector('button i');
            if (icon) icon.textContent = '+';
          }
        });
      }

      if (isOpen) {
        item.classList.remove('is-open');
        btn.setAttribute('aria-expanded', 'false');
        const icon = btn.querySelector('i');
        if (icon) icon.textContent = '+';
      } else {
        item.classList.add('is-open');
        btn.setAttribute('aria-expanded', 'true');
        const icon = btn.querySelector('i');
        if (icon) icon.textContent = '−';

        track('faq_opened', {
          question: btn.querySelector('span')?.textContent.trim()
        });
      }
    });
  });

  // 6. Feedback de Compra & Eventos WooCommerce
  const cartNotice = document.getElementById('cart-notice');
  const cartNoticeText = document.getElementById('cart-notice-text');
  const purchaseBtns = document.querySelectorAll('.btn--purchase');

  function showNotice(text, duration = 4000) {
    if (!cartNotice) return;
    if (cartNoticeText) cartNoticeText.textContent = text;
    cartNotice.style.display = 'flex';

    setTimeout(() => {
      cartNotice.style.display = 'none';
    }, duration);
  }

  purchaseBtns.forEach(btn => {
    btn.addEventListener('click', (e) => {
      const edition = btn.dataset.edition;
      const productId = btn.dataset.productId;
      const productName = btn.dataset.productName;
      const price = parseFloat(btn.dataset.productPrice || '0');

      track('edition_selected', { edition, productId });
      track('add_to_cart', {
        ecommerce: {
          currency: 'BRL',
          value: price,
          items: [{
            item_id: productId,
            item_name: productName,
            price: price,
            quantity: 1
          }]
        }
      });
      track('begin_checkout', { edition, productId });

      if (edition === 'amazon' || btn.tagName === 'A') {
        showNotice('Redirecionando para a página oficial na Amazon Brasil...');
        return;
      }

      btn.disabled = true;
      const originalText = btn.innerHTML;
      btn.innerHTML = `<span>Preparando...</span><span>◌</span>`;

      setTimeout(() => {
        btn.disabled = false;
        btn.innerHTML = originalText;
        showNotice(
          edition === 'physical'
            ? 'Livro físico (R$ 59,00) selecionado! Redirecionando para o checkout protegido...'
            : 'Edição digital (R$ 29,00) selecionada! Redirecionando para o checkout protegido...'
        );

        // Se estiver em ambiente com WooCommerce real, redirecionar:
        if (window.location.search.includes('wc-live=true')) {
          window.location.href = `/checkout/?add-to-cart=${productId}`;
        }
      }, 500);
    });
  });

  // ==========================================================================
  // 6.5. CARROSSEL DE DEPOIMENTOS EM LARGURA TOTAL
  // ==========================================================================
  function initSocialCarousel() {
    const track = document.getElementById('social-carousel-track');
    const btnPrev = document.getElementById('social-prev-btn');
    const btnNext = document.getElementById('social-next-btn');
    if (!track) return;

    const originalCards = Array.from(track.querySelectorAll('.chat-card'));
    if (!originalCards.length) return;

    // Clona conjuntos nos dois extremos para loop verdadeiramente infinito sem interrupções
    const prevClones = originalCards.map(c => {
      const clone = c.cloneNode(true);
      clone.classList.add('is-clone');
      clone.setAttribute('aria-hidden', 'true');
      return clone;
    });

    const nextClones = originalCards.map(c => {
      const clone = c.cloneNode(true);
      clone.classList.add('is-clone');
      clone.setAttribute('aria-hidden', 'true');
      return clone;
    });

    for (let i = prevClones.length - 1; i >= 0; i--) {
      track.insertBefore(prevClones[i], track.firstChild);
    }
    nextClones.forEach(c => track.appendChild(c));

    function getCardStep() {
      const card = originalCards[0];
      const gap = parseFloat(window.getComputedStyle(track).gap) || 22;
      return (card ? card.offsetWidth : 380) + gap;
    }

    function getSetDistance() {
      if (!nextClones[0] || !originalCards[0]) return 0;
      return nextClones[0].offsetLeft - originalCards[0].offsetLeft;
    }

    let isDown = false;
    let startX = 0;
    let scrollStart = 0;
    let isAnimating = false;
    let currentAnimation = null;
    let autoplayTimer = null;
    let isUserInteracting = false;

    // Normalização instantânea: mantém o scroll dentro do conjunto original [dist, 2 * dist)
    function normalizeScroll() {
      const dist = getSetDistance();
      if (!dist) return;
      while (track.scrollLeft >= 2 * dist) {
        track.scrollLeft -= dist;
        if (isDown) scrollStart -= dist;
      }
      while (track.scrollLeft < dist) {
        track.scrollLeft += dist;
        if (isDown) scrollStart += dist;
      }
    }

    // Inicialização da posição no conjunto central (original)
    function initPosition() {
      const dist = getSetDistance();
      if (dist > 0) {
        track.scrollLeft = dist;
      }
    }

    initPosition();
    setTimeout(initPosition, 120);

    // Easing customizado easeOutQuart para deslize aveludado, suave e responsivo
    function easeOutQuart(t) {
      return 1 - Math.pow(1 - t, 4);
    }

    function smoothScrollBy(delta, duration = 850) {
      if (currentAnimation) {
        cancelAnimationFrame(currentAnimation);
        currentAnimation = null;
      }

      normalizeScroll();

      const start = track.scrollLeft;
      const startTime = performance.now();
      isAnimating = true;

      function step(now) {
        const elapsed = now - startTime;
        const progress = Math.min(elapsed / duration, 1);
        const ease = easeOutQuart(progress);

        track.scrollLeft = start + delta * ease;

        if (progress < 1) {
          currentAnimation = requestAnimationFrame(step);
        } else {
          currentAnimation = null;
          isAnimating = false;
          normalizeScroll();
        }
      }

      currentAnimation = requestAnimationFrame(step);
    }

    // Botões de navegação
    btnNext?.addEventListener('click', (e) => {
      e.preventDefault();
      smoothScrollBy(getCardStep(), 850);
      resetAutoplay();
    });

    btnPrev?.addEventListener('click', (e) => {
      e.preventDefault();
      smoothScrollBy(-getCardStep(), 850);
      resetAutoplay();
    });

    // Autoplay suave e contínuo
    function startAutoplay() {
      if (autoplayTimer || isUserInteracting) return;
      autoplayTimer = setInterval(() => {
        if (!isUserInteracting && !isAnimating) {
          smoothScrollBy(getCardStep(), 900);
        }
      }, 4200);
    }

    function stopAutoplay() {
      if (autoplayTimer) {
        clearInterval(autoplayTimer);
        autoplayTimer = null;
      }
    }

    function resetAutoplay() {
      stopAutoplay();
      startAutoplay();
    }

    // Pausa o autoplay ao interagir com o carrossel ou controles
    track.addEventListener('mouseenter', () => { isUserInteracting = true; stopAutoplay(); });
    track.addEventListener('mouseleave', () => { isUserInteracting = false; startAutoplay(); });
    btnPrev?.addEventListener('mouseenter', () => { isUserInteracting = true; stopAutoplay(); });
    btnPrev?.addEventListener('mouseleave', () => { isUserInteracting = false; startAutoplay(); });
    btnNext?.addEventListener('mouseenter', () => { isUserInteracting = true; stopAutoplay(); });
    btnNext?.addEventListener('mouseleave', () => { isUserInteracting = false; startAutoplay(); });

    track.addEventListener('touchstart', () => { isUserInteracting = true; stopAutoplay(); }, { passive: true });
    track.addEventListener('touchend', () => { 
      setTimeout(() => { isUserInteracting = false; startAutoplay(); }, 1800); 
    });

    // Suporte a arrasto com o mouse no desktop (drag-to-scroll infinito)
    track.addEventListener('mousedown', (e) => {
      if (currentAnimation) {
        cancelAnimationFrame(currentAnimation);
        currentAnimation = null;
        isAnimating = false;
      }
      isDown = true;
      isUserInteracting = true;
      stopAutoplay();
      track.classList.add('is-dragging');
      startX = e.pageX - track.offsetLeft;
      scrollStart = track.scrollLeft;
    });

    window.addEventListener('mouseup', () => {
      if (isDown) {
        isDown = false;
        track.classList.remove('is-dragging');
        normalizeScroll();
        const step = getCardStep();
        const nearest = Math.round(track.scrollLeft / step) * step;
        const diff = nearest - track.scrollLeft;
        if (Math.abs(diff) > 4) {
          smoothScrollBy(diff, 480);
        }
        setTimeout(() => { isUserInteracting = false; startAutoplay(); }, 1800);
      }
    });

    track.addEventListener('mousemove', (e) => {
      if (!isDown) return;
      e.preventDefault();
      const x = e.pageX - track.offsetLeft;
      const walk = (x - startX) * 1.35;
      track.scrollLeft = scrollStart - walk;
      normalizeScroll();
    });

    // Normalização no scroll nativo (touch / trackpad)
    track.addEventListener('scroll', () => {
      if (!isAnimating && !isDown) {
        normalizeScroll();
      }
    }, { passive: true });

    window.addEventListener('resize', () => {
      normalizeScroll();
    });

    // ========================================================================
    // Efeito de rolagem: intercepta o scroll da página 2x no terço inferior
    // para avançar os depoimentos antes de descer para o próximo bloco
    // ========================================================================
    let scrollInterceptCount = 0;
    let isWheelLocked = false;
    let wheelCooldownTimer = null;
    let hasScrolledPastBelow = false;

    // Reseta o contador quando o usuário rolar para fora da seção
    window.addEventListener('scroll', () => {
      const rect = track.getBoundingClientRect();
      const vh = window.innerHeight;

      // Se rolou para cima (carrossel voltou para baixo da zona de 33%)
      if (rect.top > vh * 0.78) {
        scrollInterceptCount = 0;
        hasScrolledPastBelow = false;
      }
      // Se rolou completamente para baixo (passou para o próximo bloco / FAQ)
      if (rect.bottom < 0) {
        hasScrolledPastBelow = true;
      }
      // Se estava abaixo e voltou subindo para a seção
      if (hasScrolledPastBelow && rect.top >= 0 && rect.top <= vh * 0.75) {
        scrollInterceptCount = 0;
        hasScrolledPastBelow = false;
      }
    }, { passive: true });

    window.addEventListener('wheel', (e) => {
      // Aplica apenas em telas desktop / notebooks onde o scroll principal é via mouse/trackpad
      if (window.innerWidth <= 768) return;

      const rect = track.getBoundingClientRect();
      const vh = window.innerHeight;

      // "Quando o carrossel de depoimentos estiver a 33% inferior da tela":
      // Topo do carrossel entre 15% e 75% da altura da viewport e visível
      const inZone = rect.top <= vh * 0.75 && rect.top >= vh * 0.15 && rect.bottom >= vh * 0.30;
      if (!inZone) return;

      // Se o usuário estiver rolando para CIMA (deltaY < 0):
      // Permite rolagem suave para cima sem travar a navegação
      if (e.deltaY < 0) {
        if (isWheelLocked) {
          isWheelLocked = false;
          clearTimeout(wheelCooldownTimer);
        }
        return;
      }

      // Se estiver rolando para BAIXO (deltaY > 0):
      if (Math.abs(e.deltaY) < 6) return;

      // Consome a inércia/flick do gesto durante a animação do passo atual
      if (isWheelLocked) {
        e.preventDefault();
        return;
      }

      // Se ainda não completou os 2 scrolls horizontais
      if (scrollInterceptCount < 2) {
        e.preventDefault();

        isUserInteracting = true;
        stopAutoplay();

        // Rola os depoimentos para o próximo conjunto de cards
        smoothScrollBy(getCardStep(), 500);

        scrollInterceptCount++;
        isWheelLocked = true;

        clearTimeout(wheelCooldownTimer);
        wheelCooldownTimer = setTimeout(() => {
          isWheelLocked = false;
          setTimeout(() => {
            isUserInteracting = false;
            startAutoplay();
          }, 2000);
        }, 500);
      }
      // Quando scrollInterceptCount >= 2, o preventDefault NÃO é chamado,
      // permitindo que o scroll do mouse role a página livremente para o próximo bloco!
    }, { passive: false });

    startAutoplay();
  }

  initSocialCarousel();

  // 7. Rolagem suave para todos os links com hash
  document.querySelectorAll('a[href^="#"]').forEach(link => {
    link.addEventListener('click', (e) => {
      const targetId = link.getAttribute('href');
      if (targetId === '#' || !targetId) return;

      const targetEl = document.querySelector(targetId);
      if (targetEl) {
        e.preventDefault();
        targetEl.scrollIntoView({ behavior: 'smooth', block: 'start' });
      }
    });
  });

  // 8. Animação de Zoom e Folheação Rápida do Livro (Seção 01) — Thumb Riffle
  function initBookFlipOnScroll() {
    const stage = document.getElementById('book-riffle-stage');
    if (!stage) return;

    const frontCover = document.getElementById('riffle-front-cover');
    const leaves = Array.from(document.querySelectorAll('.riffle-leaf'));

    let isPlaying = false;
    let hasAnimated = false;
    let lockedScrollY = 0;

    function resetRiffle() {
      stage.classList.remove('is-active', 'is-zoomed', 'show-title');
      if (frontCover) {
        frontCover.style.transition = 'none';
        frontCover.style.transform = 'rotateY(0deg)';
      }
      leaves.forEach((l) => {
        l.style.transition = 'none';
        l.style.transform = 'rotateY(0deg)';
        const shadow = l.querySelector('.riffle-leaf__shadow');
        if (shadow) shadow.style.opacity = '0';
      });
    }

    function playRiffleAnimation(onComplete) {
      if (isPlaying) return;
      isPlaying = true;
      lockedScrollY = window.scrollY;

      // 1. Zoom in: amplia na tela
      resetRiffle();
      stage.classList.add('is-active');

      requestAnimationFrame(() => {
        requestAnimationFrame(() => {
          stage.classList.add('is-zoomed');
        });
      });

      // 2. Após zoom (0.55s), inicia a folheação rápida idêntica ao vídeo
      setTimeout(() => {
        // A capa abre e inclina ligeiramente revelando as páginas
        if (frontCover) {
          frontCover.style.transition = 'transform 0.45s cubic-bezier(0.2, 0.9, 0.3, 1)';
          frontCover.style.transform = 'rotateY(-68deg) skewY(-3deg)';
        }

        // As folhas folheiam em cascata ultra-rápida (rapid thumb riffle, ~55ms entre cada página)
        const totalLeaves = leaves.length;
        leaves.forEach((leaf, idx) => {
          const delay = 120 + (idx * 55);
          const duration = 0.22;
          const targetAngle = -50 - (idx * 1.5);

          setTimeout(() => {
            leaf.style.transition = `transform ${duration}s cubic-bezier(0.25, 1, 0.5, 1)`;
            leaf.style.transform = `rotateY(${targetAngle}deg) skewY(-2deg)`;

            const shadow = leaf.querySelector('.riffle-leaf__shadow');
            if (shadow) {
              shadow.style.opacity = '0.7';
              setTimeout(() => { shadow.style.opacity = '0'; }, duration * 600);
            }
          }, delay);
        });

        // 3. Ao invés de voltar para a capa, o livro dissolve e surge o Título bem grande com fade in (Print 2)
        const finishTime = 120 + (totalLeaves * 55) + 240;
        setTimeout(() => {
          stage.classList.add('show-title');

          // 4. Permanece exibindo o título cinematográfico e conclui mantendo a página 100% estática no mesmo bloco
          setTimeout(() => {
            stage.style.transition = 'opacity 0.6s ease';
            stage.classList.remove('is-active');

            setTimeout(() => {
              stage.classList.remove('is-zoomed', 'show-title');
              isPlaying = false;
              hasAnimated = true;
              if (onComplete) onComplete();
            }, 600);
          }, 1800); // Exibição do título

        }, finishTime);

      }, 550);
    }

    // Clique direto no livro para disparar a qualquer momento
    const bookTrigger = document.getElementById('book-still-interactive');
    if (bookTrigger) {
      bookTrigger.addEventListener('click', () => {
        playRiffleAnimation();
      });
    }

    // Clique no próprio overlay para acelerar/pular se desejado
    stage.addEventListener('click', () => {
      if (isPlaying) {
        stage.style.transition = 'opacity 0.35s ease';
        stage.classList.remove('is-active');
        setTimeout(() => {
          stage.classList.remove('is-zoomed', 'show-title');
          isPlaying = false;
          hasAnimated = true;
        }, 350);
      }
    });

    // Impede propagação de scroll ou toque que ocorra diretamente sobre o overlay do livro
    stage.addEventListener('wheel', (e) => {
      e.preventDefault();
      e.stopPropagation();
    }, { passive: false, capture: true });

    stage.addEventListener('touchmove', (e) => {
      e.preventDefault();
      e.stopPropagation();
    }, { passive: false, capture: true });

    // Função para verificar se a página atingiu a posição exata de disparo da animação:
    // - Em telas grandes (Print 1): ativa com a Seção 01 no topo (com ~15% a 22% do final da hero visível no topo)
    // - Em telas menores / 1280x720 (Print 2): ativa quando o título rolou para fora e o livro 3D está centralizado na tela
    function shouldTriggerRiffle() {
      const whySection = document.getElementById('livro');
      if (!whySection) return false;

      const rect = whySection.getBoundingClientRect();
      const vh = window.innerHeight;
      const vw = window.innerWidth;

      // Tela Grande (Desktop grande, >= 1400px de largura e >= 820px de altura)
      const isLargeScreen = vw >= 1400 && vh >= 820;

      if (isLargeScreen) {
        // Posição Print 1: O topo da Seção 01 chegou ao início da tela (com ~15% a 22% do final da hero visível no topo)
        return rect.top <= vh * 0.22 && rect.bottom >= vh * 0.40;
      } else {
        // Posição Print 2 (Telas menores / Laptops / 1280x720):
        // O cabeçalho rolou para fora do topo e o livro 3D está centralizado/em destaque
        const bookEl = document.getElementById('book-still-interactive') || whySection;
        const bookRect = bookEl.getBoundingClientRect();
        const headingEl = whySection.querySelector('.section-heading');
        const headingPast = headingEl ? headingEl.getBoundingClientRect().bottom <= 80 : rect.top <= -100;

        return headingPast && bookRect.top <= vh * 0.22 && bookRect.bottom >= vh * 0.65;
      }
    }

    // Interceptação de Scroll: ativa com apenas um scroll quando o bloco da Seção 01 está enquadrado na posição exata
    window.addEventListener('wheel', (e) => {
      // Quando a animação estiver ocorrendo, a página de fundo NUNCA deve rolar
      if (isPlaying) {
        e.preventDefault();
        e.stopPropagation();
        return;
      }

      if (hasAnimated) return;

      if (shouldTriggerRiffle() && e.deltaY > 0) {
        e.preventDefault();
        e.stopPropagation();
        playRiffleAnimation();
      }
    }, { passive: false, capture: true });

    // Touch gesture no mobile (arrasto para cima = scroll para baixo)
    let touchStartY = 0;
    window.addEventListener('touchstart', (e) => {
      if (e.touches && e.touches[0]) {
        touchStartY = e.touches[0].clientY;
      }
    }, { passive: true });

    window.addEventListener('touchmove', (e) => {
      // Quando a animação estiver ocorrendo, a página de fundo NUNCA deve rolar
      if (isPlaying) {
        e.preventDefault();
        e.stopPropagation();
        return;
      }
      if (hasAnimated || !e.touches || !e.touches[0]) return;

      const currentY = e.touches[0].clientY;
      const diffY = touchStartY - currentY;

      if (shouldTriggerRiffle() && diffY > 25) {
        e.preventDefault();
        e.stopPropagation();
        playRiffleAnimation();
      }
    }, { passive: false, capture: true });

    // Teclas de navegação travadas durante a animação
    window.addEventListener('keydown', (e) => {
      if (isPlaying && ['ArrowDown', 'ArrowUp', 'Space', 'PageDown', 'PageUp', 'Home', 'End'].includes(e.code)) {
        e.preventDefault();
      }
    }, { capture: true });

    // Trava de segurança: se qualquer rolagem tentar mover a página de fundo durante a animação, mantém na posição exata
    window.addEventListener('scroll', () => {
      if (isPlaying) {
        window.scrollTo(0, lockedScrollY);
        return;
      }
      if (window.scrollY < 200) {
        hasAnimated = false;
      }
    });
  }

  initBookFlipOnScroll();
});
