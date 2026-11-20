import { useEffect, useState } from "react";

type Edition = "physical" | "digital";

type FAQItem = {
  question: string;
  answer: string;
};

const heroAsset = "/hero_autor_livro.png";
const authorAsset = "/editorial_autor_livro.png";

const topics = [
  {
    number: "01",
    title: "O Ponto de Ruptura",
    description: "A desconstrução de certezas antigas e a compreensão exata do momento em que recuar não é mais uma alternativa.",
  },
  {
    number: "02",
    title: "A Travessia das Adversidades",
    description: "Os bastidores reais e silenciosos de quem já faliu, perdeu tudo e teve de reconstruir a própria reputação e clareza do zero.",
  },
  {
    number: "03",
    title: "Visão, Dinheiro e Poder",
    description: "Uma abordagem madura e livre de romantismo sobre o papel dos recursos materiais, a ambição equilibrada e a responsabilidade das escolhas.",
  },
  {
    number: "04",
    title: "O Pacto e os Princípios",
    description: "As diretrizes e compromissos internos que impedem um líder de negociar sua dignidade e seu foco nas fases mais exigentes.",
  },
  {
    number: "05",
    title: "O Próximo Capítulo",
    description: "Como transformar cicatrizes e aprendizados acumulados em sabedoria prática para construir uma história digna de ser contada.",
  },
];

const faqs: FAQItem[] = [
  {
    question: "Qual é a diferença entre a edição física e a digital?",
    answer: "O conteúdo integral da obra é rigorosamente o mesmo em ambas as versões. A edição física é impressa com acabamento editorial superior, orelhas e papel encorpado de alta gramatura para leitura tátil. A edição digital está disponível nos formatos PDF e ePub, pronta para ser lida instantaneamente em Kindle, Kobo, tablets, smartphones e computadores.",
  },
  {
    question: "Como funciona o envio do livro físico?",
    answer: "O exemplar físico é despachado via correios ou transportadora oficial com código de rastreamento enviado por e-mail. O frete e o prazo exato de entrega para a sua região são calculados diretamente na tela de checkout do WooCommerce antes da confirmação do pagamento.",
  },
  {
    question: "Como recebo a edição digital?",
    answer: "Assim que a confirmação do pagamento for processada, você receberá instantaneamente um e-mail com os links seguros para download nos formatos PDF e ePub, além de ter os arquivos disponíveis em sua área de cliente na loja.",
  },
  {
    question: "Quais formas de pagamento estão disponíveis?",
    answer: "A compra é processada com segurança total via checkout WooCommerce, com suporte a PIX (com liberação imediata), Cartão de Crédito (com parcelamento disponível conforme as condições da loja) e Boleto Bancário.",
  },
  {
    question: "Posso comprar para presentear?",
    answer: "Sim. Para o livro físico, basta inserir o endereço da pessoa presenteada como endereço de entrega no checkout. Para a edição digital, você pode adquirir o exemplar e encaminhar o arquivo e o link de acesso ao destinatário.",
  },
  {
    question: "Como falar com o suporte?",
    answer: "Caso tenha qualquer dúvida sobre o pedido, código de rastreio ou acesso aos arquivos digitais, nossa equipe de suporte está à disposição pelos canais oficiais de atendimento informados no rodapé da página.",
  },
];

function track(event: string, payload: Record<string, string> = {}) {
  if (typeof window === "undefined") return;
  window.dispatchEvent(new CustomEvent("pacto:analytics", { detail: { event, ...payload } }));
  const dataLayer = (window as Window & { dataLayer?: unknown[] }).dataLayer;
  dataLayer?.push({ event, ...payload });
}

function scrollToPurchase(source: string) {
  track("cta_click", { source });
  document.getElementById("compra")?.scrollIntoView({ behavior: "smooth", block: "start" });
}

function LineIcon({ type }: { type: "perspective" | "revisit" | "formats" }) {
  if (type === "perspective") {
    return (
      <svg aria-hidden="true" viewBox="0 0 32 32" className="line-icon">
        <circle cx="16" cy="16" r="10" />
        <path d="M6 16h20M16 6c3 3 4.5 6.3 4.5 10S19 23 16 26M16 6c-3 3-4.5 6.3-4.5 10S13 23 16 26" />
      </svg>
    );
  }
  if (type === "revisit") {
    return (
      <svg aria-hidden="true" viewBox="0 0 32 32" className="line-icon">
        <path d="M8 8h16v17H8zM11 5h10M12 13h8M12 18h6" />
      </svg>
    );
  }
  return (
    <svg aria-hidden="true" viewBox="0 0 32 32" className="line-icon">
      <path d="M7 8h13v17H7zM12 8v17M12 11h13v17H12" />
    </svg>
  );
}

function AssetFrame({
  src,
  alt,
  kind,
}: {
  src: string;
  alt: string;
  kind: "hero" | "author";
}) {
  const [loaded, setLoaded] = useState(false);
  const [failed, setFailed] = useState(false);

  return (
    <div className={`asset-frame asset-frame--${kind} ${loaded ? "is-loaded" : ""}`}>
      {!failed && (
        <img
          className="client-asset"
          src={src}
          alt={alt}
          loading={kind === "hero" ? "eager" : "lazy"}
          onLoad={() => setLoaded(true)}
          onError={() => setFailed(true)}
        />
      )}
      {(!loaded || failed) && <EditorialFallback kind={kind} />}
    </div>
  );
}

function EditorialFallback({ kind }: { kind: "hero" | "author" }) {
  if (kind === "author") {
    return (
      <div className="author-fallback" aria-label="Área reservada para editorial_autor_livro.png">
        <div className="author-silhouette">
          <span className="author-head" />
          <span className="author-shoulder" />
        </div>
        <span className="fallback-caption">editorial_autor_livro.png</span>
      </div>
    );
  }

  return (
    <div className="hero-fallback" aria-label="Área reservada para hero_autor_livro.png">
      <div className="fallback-glow" />
      <div className="fallback-book">
        <span className="fallback-book-line" />
        <span className="fallback-book-kicker">UMA LEITURA SOBRE</span>
        <strong>O PACTO<br />DE 1 BILHÃO</strong>
        <span className="fallback-book-rule" />
        <span className="fallback-book-small">[capa oficial]</span>
      </div>
      <span className="fallback-caption">hero_autor_livro.png</span>
    </div>
  );
}

export default function Home() {
  const [openFaq, setOpenFaq] = useState<number | null>(null);
  const [dismissSticky, setDismissSticky] = useState(false);
  const [showSticky, setShowSticky] = useState(false);
  const [loadingEdition, setLoadingEdition] = useState<Edition | null>(null);
  const [notice, setNotice] = useState("");

  useEffect(() => {
    track("hero_view");
    const revealTargets = document.querySelectorAll("[data-reveal]");
    if (typeof IntersectionObserver === "undefined") {
      revealTargets.forEach((element) => element.classList.add("is-visible"));
    }

    let revealObserver: IntersectionObserver | null = null;
    if (typeof IntersectionObserver !== "undefined") {
      revealObserver = new IntersectionObserver(
        (entries) => {
          entries.forEach((entry) => {
            if (entry.isIntersecting) {
              entry.target.classList.add("is-visible");
              revealObserver?.unobserve(entry.target);
            }
          });
        },
        { threshold: 0.12 },
      );
      revealTargets.forEach((element) => revealObserver?.observe(element));
    }

    const onScroll = () => {
      setShowSticky(window.scrollY > window.innerHeight * 0.72);
    };
    window.addEventListener("scroll", onScroll, { passive: true });
    onScroll();

    return () => {
      revealObserver?.disconnect();
      window.removeEventListener("scroll", onScroll);
    };
  }, []);

  const handleEditionClick = (edition: Edition) => {
    setLoadingEdition(edition);
    track("edition_selected", { edition });
    window.setTimeout(() => {
      setLoadingEdition(null);
      setNotice(
        edition === "physical"
          ? "Produto físico adicionado ao carrinho WooCommerce. Redirecionando..."
          : "Edição digital adicionada ao carrinho WooCommerce. Redirecionando...",
      );
      track("add_to_cart", { edition, status: "success" });
      track("begin_checkout", { edition, status: "success" });
      window.setTimeout(() => setNotice(""), 4200);
    }, 520);
  };

  return (
    <div className="site-shell">
      <div className="trust-bar">
        <div className="shell-container trust-bar__inner">
          <span className="trust-dot" />
          <span>Livro físico e digital</span>
          <span className="trust-divider" />
          <span>Compra segura pelo WooCommerce</span>
          <span className="trust-divider" />
          <span>Distribuição Oficial</span>
          <span className="trust-note">Pagamento protegido com SSL 256 bits</span>
        </div>
      </div>

      <header className="site-header shell-container" aria-label="Navegação principal">
        <nav className="desktop-nav" aria-label="Navegação da página">
          <a href="#livro">O livro</a>
          <a href="#autor">O autor</a>
          <a href="#temas">Capítulos</a>
          <a href="#compra">Edições</a>
          <a href="#faq">Dúvidas</a>
        </nav>
        <button className="header-cta" onClick={() => scrollToPurchase("header")}>Comprar com desconto agora <span>↗</span></button>
      </header>

      <main>
        <section className="hero" id="inicio" data-section="hero">
          <div className="hero-bg" aria-hidden="true">
            <img 
              className="hero-bg-img" 
              src={heroAsset} 
              alt="Salih Abdulatif segurando o livro O Pacto de 1 Bilhão" 
              width={2560} 
              height={1440} 
              fetchPriority="high" 
            />
            <div className="hero-bg-overlay" />
          </div>
          <div className="shell-container hero__grid">
            <div className="hero__copy">
              <p className="eyebrow hero-reveal hero-reveal--1"><span /> Um livro sobre visão, poder e transformação</p>
              <h1 className="hero-reveal hero-reveal--2"><span className="hero-title-line">O Pacto de</span><br /><em>1 Bilhão</em></h1>
              <p className="hero-subtitle hero-reveal hero-reveal--3">Uma leitura para quem quer ampliar a própria visão sobre dinheiro, poder e as grandes viradas da vida.</p>
              <div className="hero-actions hero-reveal hero-reveal--4">
                <button className="button button--gold" onClick={() => scrollToPurchase("hero_primary")}>Quero garantir meu livro <span>↗</span></button>
                <a className="text-link" href="#livro" onClick={() => track("cta_click", { source: "hero_secondary" })}>Conhecer o livro <span>↓</span></a>
              </div>
              <div className="hero-meta hero-reveal hero-reveal--5">
                <span className="meta-lock">⌁</span>
                <span>Pagamento seguro • Checkout protegido • Acesso conforme a opção escolhida</span>
              </div>
            </div>
            <div className="hero__visual-space" aria-hidden="true" />
          </div>
          <a className="hero-scroll" href="#livro" aria-label="Descer para o livro"><span>Scroll para explorar</span><i /></a>
        </section>

        <section className="section section--light why" id="livro" data-section="book-value">
          <div className="shell-container">
            <div className="section-heading section-heading--split" data-reveal>
              <div><span className="section-index">01 — POR QUE ESTE LIVRO?</span><h2>Uma obra para levar<br />consigo <em>além da<br />primeira leitura.</em></h2></div>
              <div className="section-heading__desc">
                <p>Mais do que um livro, esta é uma oportunidade de parar, observar o próprio caminho e rever as decisões que moldam uma grande virada. A obra convida o leitor a enxergar novas possibilidades com mais clareza, intenção e responsabilidade.</p>
                <p>Uma trajetória marcada por altos e baixos, desafios superados e uma busca constante pelo crescimento.</p>
              </div>
            </div>
            <div className="why__body">
              <div className="book-still" data-reveal>
                <img 
                  src="/livro_3d_novo.png" 
                  alt="Livro O Pacto de 1 Bilhão por Salih Abdulatif — Edição Oficial em 3D" 
                  className="book-still__img" 
                />
              </div>
              <div className="why-list" data-reveal>
                <div className="why-list__item"><b>01</b><p>Uma leitura para ampliar sua perspectiva.</p></div>
                <div className="why-list__item"><b>02</b><p>Para quem busca uma nova estratégia sobre crescimento e realização.</p></div>
                <div className="why-list__item"><b>03</b><p>Conteúdo para revisitar e aplicar ao longo do tempo.</p></div>
                <div className="why-list__item"><b>04</b><p>Para quem valoriza histórias, aprendizados e decisões que deixam marca.</p></div>
              </div>
            </div>
          </div>
        </section>

        <section className="section author" id="autor" data-section="author">
          <div className="shell-container author__grid">
            <div className="author__visual" data-reveal><AssetFrame src={authorAsset} alt="Salih Abdulatif em composição editorial segurando edições do livro" kind="author" /></div>
            <div className="author__copy" data-reveal>
              <span className="section-index">02 — A HISTÓRIA POR TRÁS DA OBRA</span>
              <h2>A palavra ganha peso quando carrega uma <em>trajetória.</em></h2>
              <p className="author__lead">
                Salih Abdulatif é um empresário brasileiro e turco que se orgulha das duas nacionalidades. Nasceu numa roça em Rondônia, foi criado pelo avô libanês e começou a trabalhar aos 12 anos de idade. Aprendeu árabe e outros três idiomas quase por acidente, sem nunca ter entrado em uma universidade formal.
              </p>
              <p className="author__lead" style={{ marginTop: "1rem" }}>
                Em sua jornada, abriu 23 empresas em nove países, conhecendo tanto a geração de grandes volumes quanto o peso de perdas completas. Falido cinco vezes e com dívidas acumuladas aos 40 anos, começou a escrever este livro para relatar o seu pacto de um bilhão. Casado e pai de três filhos, vive entre Istambul, Dubai e o Rio de Janeiro.
              </p>
              <div className="author__line" />
              <p className="author__caption">
                “Um homem que já morreu uma vez não tem mais medo de quase nada.” — Salih Abdulatif
              </p>
            </div>
          </div>
        </section>

        {/* FAIXA ROTATIVA / MARQUEE TICKER */}
        <aside className="marquee-ticker" role="region" aria-label="Mensagem em destaque">
          <div className="marquee-ticker__inner" aria-hidden="true">
            <div className="marquee-ticker__track">
              <span className="marquee-ticker__item">Uma oportunidade de parar, observar o próprio caminho e rever as decisões que moldam a sua <em>grande virada.</em> <span className="marquee-ticker__sep">◆</span></span>
              <span className="marquee-ticker__item">Uma oportunidade de parar, observar o próprio caminho e rever as decisões que moldam a sua <em>grande virada.</em> <span className="marquee-ticker__sep">◆</span></span>
              <span className="marquee-ticker__item">Uma oportunidade de parar, observar o próprio caminho e rever as decisões que moldam a sua <em>grande virada.</em> <span className="marquee-ticker__sep">◆</span></span>
              <span className="marquee-ticker__item">Uma oportunidade de parar, observar o próprio caminho e rever as decisões que moldam a sua <em>grande virada.</em> <span className="marquee-ticker__sep">◆</span></span>
              <span className="marquee-ticker__item">Uma oportunidade de parar, observar o próprio caminho e rever as decisões que moldam a sua <em>grande virada.</em> <span className="marquee-ticker__sep">◆</span></span>
              <span className="marquee-ticker__item">Uma oportunidade de parar, observar o próprio caminho e rever as decisões que moldam a sua <em>grande virada.</em> <span className="marquee-ticker__sep">◆</span></span>
            </div>
            <div className="marquee-ticker__track">
              <span className="marquee-ticker__item">Uma oportunidade de parar, observar o próprio caminho e rever as decisões que moldam a sua <em>grande virada.</em> <span className="marquee-ticker__sep">◆</span></span>
              <span className="marquee-ticker__item">Uma oportunidade de parar, observar o próprio caminho e rever as decisões que moldam a sua <em>grande virada.</em> <span className="marquee-ticker__sep">◆</span></span>
              <span className="marquee-ticker__item">Uma oportunidade de parar, observar o próprio caminho e rever as decisões que moldam a sua <em>grande virada.</em> <span className="marquee-ticker__sep">◆</span></span>
              <span className="marquee-ticker__item">Uma oportunidade de parar, observar o próprio caminho e rever as decisões que moldam a sua <em>grande virada.</em> <span className="marquee-ticker__sep">◆</span></span>
              <span className="marquee-ticker__item">Uma oportunidade de parar, observar o próprio caminho e rever as decisões que moldam a sua <em>grande virada.</em> <span className="marquee-ticker__sep">◆</span></span>
              <span className="marquee-ticker__item">Uma oportunidade de parar, observar o próprio caminho e rever as decisões que moldam a sua <em>grande virada.</em> <span className="marquee-ticker__sep">◆</span></span>
            </div>
          </div>
        </aside>

        <section className="section section--navy topics" id="temas" data-section="topics">
          <div className="topics-ambient" aria-hidden="true" />
          <div className="shell-container">
            <div className="section-heading section-heading--topics" data-reveal>
              <div><span className="section-index">03 — O QUE O LEITOR ENCONTRARÁ</span><h2>Uma jornada em<br /><em>cinco movimentos.</em></h2></div>
              <div className="section-heading__desc">
                <p>Uma narrativa estruturada em torno dos dilemas fundamentais de quem decide persistir diante dos cenários mais improváveis.</p>
                <p>“Sei exatamente quem sou com um milhão de dólares na conta. E sei exatamente quem sou com um milhão de dólares em dívidas.” — Salih Abdulatif</p>
              </div>
            </div>
            <div className="topic-list">
              {topics.map((topic) => <div className="topic-row" key={topic.number} data-reveal><span className="topic-number">{topic.number}</span><h3>{topic.title}</h3><p>{topic.description}</p><span className="topic-arrow">↗</span></div>)}
            </div>
          </div>
        </section>

        <section className="section editions" id="compra" data-section="purchase">
          <div className="shell-container">
            <div className="section-heading section-heading--purchase" data-reveal><div><span className="section-index">04 — ESCOLHA SUA EDIÇÃO</span><h2>Leve esta leitura<br /><em>para o seu próximo capítulo.</em></h2></div><p>Falido pela quinta vez, devendo um milhão de dólares, um homem faz um pacto com Deus. Sete cláusulas. A última delas: <strong style={{ color: "#92774a", fontWeight: 700 }}>um bilhão de dólares</strong>. O que ele ofereceu em troca, se recusa a revelar. Para chegar até ali, saiu de uma roça no interior de Rondônia para <strong style={{ color: "#92774a", fontWeight: 700 }}>Dubai</strong> e Istambul, abriu <strong style={{ color: "#92774a", fontWeight: 700 }}>vinte e três empresas</strong>, ganhou fortunas e perdeu todas. Este não é um livro sobre como alguém ficou rico. É o registro, em tempo real, de alguém tentando. E ninguém, nem mesmo ele, sabe ainda como termina.</p></div>
            <div className="edition-grid" id="edicoes">
              <article className="edition-card" data-edition="physical" data-reveal>
                <div className="edition-card__top"><span className="edition-label">EDIÇÃO 01</span><span className="edition-format">FÍSICO</span></div>
                <div className="edition-card__visual"><div className="mini-book"><small>SALIH ABDULATIF</small><strong>O PACTO<br />DE 1 BILHÃO</strong><i /></div><span className="mini-note">Acabamento editorial com orelhas</span></div>
                <div className="edition-card__content"><h3>Livro físico</h3><p>Exemplar impresso com capa nobre, papel encorpado de alta gramatura e tipografia confortável para sua estante e biblioteca.</p><div className="edition-price">R$ 89,90</div><span className="edition-detail">Envio: Envio para todo o Brasil • Frete e prazo calculados no checkout</span><button className="button button--dark" data-woocommerce-product="book-physical" data-product-id="101" onClick={() => handleEditionClick("physical")} disabled={loadingEdition === "physical"}>{loadingEdition === "physical" ? "Preparando…" : "Comprar livro físico"}<span>↗</span></button></div>
              </article>
              <article className="edition-card edition-card--digital" data-edition="digital" data-reveal>
                <div className="edition-card__top"><span className="edition-label">EDIÇÃO 02</span><span className="edition-format">DIGITAL</span></div>
                <div className="edition-card__visual"><div className="digital-sheet"><span>PDF / EPUB</span><strong>O PACTO<br />DE 1 BILHÃO</strong><i /></div><span className="mini-note">Download instantâneo</span></div>
                <div className="edition-card__content"><h3>Livro digital</h3><p>Acesso imediato nos formatos PDF e ePub, otimizado para leitura fluida em Kindle, Kobo, iPad, celular ou computador.</p><div className="edition-price">R$ 49,90</div><span className="edition-detail">Entrega: Acesso imediato por e-mail e painel da conta após a confirmação</span><button className="button button--dark" data-woocommerce-product="book-digital" data-product-id="102" onClick={() => handleEditionClick("digital")} disabled={loadingEdition === "digital"}>{loadingEdition === "digital" ? "Preparando…" : "Comprar edição digital"}<span>↗</span></button></div>
              </article>
            </div>
            <p className="purchase-note"><span>◌</span> Compra processada com total segurança pelo WooCommerce. Checkout protegido por criptografia SSL de 256 bits.</p>
          </div>
        </section>

        <section className="section social-proof" data-section="social-proof">
          <div className="shell-container">
            <div className="social-proof__head" data-reveal>
              <div>
                <span className="section-index">05 — PROVA SOCIAL</span>
                <h2>A experiência de quem<br /><em>já encontrou estas páginas.</em></h2>
              </div>
              <div className="social-proof__desc">
                <p>Palavras e reflexões autênticas dos primeiros leitores e da síntese editorial oficial da obra.</p>
                <p>“Este não é um livro de quem chegou lá. É um livro escrito de dentro do buraco.” — Salih Abdulatif</p>
              </div>
            </div>
            <div className="quote-placeholders" data-reveal>
              <div><span>01</span><p>“Um homem que já morreu uma vez não tem mais medo de quase nada.”<br /><small style={{ color: "#92774a", marginTop: "6px", display: "block" }}>— Salih Abdulatif, autor</small></p></div>
              <div><span>02</span><p>“Perdi tudo cinco vezes. Depois da última, fiz um pacto de sete cláusulas. A última delas: um bilhão de dólares.”<br /><small style={{ color: "#92774a", marginTop: "6px", display: "block" }}>— Trecho dos bastidores da obra</small></p></div>
              <div><span>03</span><p>“Este não é um livro sobre como alguém ficou rico. É o registro, em tempo real, de alguém tentando. E ninguém, nem mesmo ele, sabe ainda como termina.”<br /><small style={{ color: "#92774a", marginTop: "6px", display: "block" }}>— Síntese editorial da orelha</small></p></div>
            </div>
          </div>
        </section>

        <section className="section faq" id="faq" data-section="faq">
          <div className="shell-container faq__grid">
            <div className="faq__intro" data-reveal><span className="section-index">06 — OBJEÇÕES E FAQ</span><h2>Antes de escolher,<br /><em>tire suas dúvidas.</em></h2><p>Respostas transparentes e oficiais sobre o formato, envio e pagamento da sua compra.</p><a href="#rodape">Falar com o suporte <span>↗</span></a></div>
            <div className="faq-list" data-reveal>
              {faqs.map((faq, index) => <div className={`faq-item ${openFaq === index ? "is-open" : ""}`} key={faq.question}><button id={`faq-button-${index}`} aria-expanded={openFaq === index} aria-controls={`faq-answer-${index}`} onClick={() => setOpenFaq(openFaq === index ? null : index)}><span>{faq.question}</span><i aria-hidden="true">{openFaq === index ? "−" : "+"}</i></button><div id={`faq-answer-${index}`} role="region" aria-labelledby={`faq-button-${index}`} aria-hidden={openFaq !== index} className="faq-answer"><p>{faq.answer}</p></div></div>)}
            </div>
          </div>
        </section>

        <section className="final-cta" data-section="final-cta">
          <div className="final-cta__orb" />
          <div className="shell-container final-cta__inner" data-reveal><div><span className="section-index">07 — UMA DECISÃO</span><h2>A próxima grande virada<br /><em>começa com uma decisão.</em></h2><p>Escolha sua edição e leve esta leitura para o seu próximo capítulo. Uma obra sóbria, profunda e transformadora para a sua jornada.</p><button className="button button--gold" onClick={() => scrollToPurchase("final_cta")}>Comprar com desconto agora <span>↗</span></button></div><div className="final-mini-book"><span>O PACTO<br /><b>DE 1 BILHÃO</b></span></div></div>
        </section>
      </main>

      <footer className="site-footer" id="rodape">
        <div className="shell-container site-footer__top"><div className="footer-brand"><p style={{ fontSize: "14px", fontFamily: "var(--serif)", color: "var(--gold-soft)", marginBottom: "8px", fontWeight: 600 }}>O Pacto de 1 Bilhão</p><p>Registro editorial e reflexões de Salih Abdulatif.<br />Canais oficiais de atendimento e distribuição</p></div><div className="footer-links"><a href="#inicio">Início</a><a href="#livro">Sobre a obra</a><a href="#autor">O autor</a><a href="#compra">Edições</a><a href="#faq">Dúvidas frequentes</a></div></div>
        <div className="shell-container site-footer__bottom"><span>© 2026 Salih Abdulatif. Todos os direitos reservados.</span><span>Aviso legal: O livro retrata a experiência pessoal do autor. Não constitui promessa de ganhos ou sucesso financeiro garantido.</span><a href="#inicio">Voltar ao topo ↑</a></div>
      </footer>

      {showSticky && !dismissSticky && <div className="sticky-cta" role="complementary"><button className="sticky-cta__close" aria-label="Fechar chamada fixa" onClick={() => setDismissSticky(true)}>×</button><div><span>O Pacto de 1 Bilhão</span><small>Físico e Digital</small></div><button className="button button--gold" onClick={() => scrollToPurchase("sticky_mobile")}>Ver edições <span>↗</span></button></div>}
      {notice && <div className="cart-notice" role="status"><span>✓</span>{notice}</div>}
    </div>
  );
}
