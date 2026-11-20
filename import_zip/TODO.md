# Entregas — O Pacto de 1 Bilhão

## Landing page editorial responsiva
- [x] Criar uma landing page premium para venda do livro “O Pacto de 1 Bilhão”, com leitura clara em telas de 360 px a 1440 px e CTA principal evidente.
- [x] Usar paleta azul-marinho profundo, grafite, branco quente/marfim e champagne/dourado discreto, com tipografia editorial para títulos e sans-serif limpa para textos e compra.
- [x] Usar HTML semântico, foco visível para teclado, labels acessíveis, rolagem suave e respeito a `prefers-reduced-motion`.

## Hero e navegação de decisão
- [x] Incluir barra superior “Livro físico e digital • Compra segura pelo WooCommerce”.
- [x] Preparar o hero para `hero_autor_livro.png`, com espaço negativo à esquerda e composição do autor/livro à direita quando o asset estiver presente.
- [x] Incluir eyebrow, título, subtítulo, texto de apoio e CTAs fornecidos: “QUERO GARANTIR MEU LIVRO” e “CONHECER O LIVRO”.
- [x] Implementar entrada progressiva do hero, brilho ambiente sutil e fallback visual não-factual enquanto o asset do cliente não estiver no projeto.
- [x] Incluir faixa curta com os três benefícios editoriais fornecidos e marcadores lineares próprios.

## Conteúdo editorial e autoridade
- [x] Criar a seção “Por que este livro?” com o texto-base editável e os três enquadramentos editoriais, sem promessas ou resultados garantidos.
- [x] Preparar a seção “A história por trás da obra” para `editorial_autor_livro.png`, com placeholder explícito para biografia verdadeira e sem credenciais inventadas.
- [x] Criar “O que o leitor encontrará” com cinco tópicos editáveis, títulos curtos, descrições de duas linhas, numeração elegante e reveal sutil.

## Compra WooCommerce preparada
- [x] Criar “Escolha sua edição” com opções Livro físico e Livro digital, descrições, preço `[R$ 00,00]`, entrega editável e CTAs específicos.
- [x] Preparar IDs, classes e `data-woocommerce-product` para conectar cada CTA a produtos/variações reais do WooCommerce posteriormente.
- [x] Implementar hover, foco, estado de carregamento, feedback de carrinho e eventos de analytics sem simular checkout real.
- [x] Manter escolhas comerciais não confirmadas como campos editáveis, sem desconto, bônus, escassez, garantia, prazo ou comparação de preço inventados.

## Prova social, FAQ e fechamento
- [x] Reservar componente de prova social com três placeholders claramente identificados e sem depoimentos fictícios.
- [x] Implementar FAQ acessível em acordeão com seis perguntas editáveis e respostas ainda não preenchidas.
- [x] Criar CTA final em azul-marinho profundo com o texto fornecido e botão “ESCOLHER MINHA EDIÇÃO”.
- [x] Criar rodapé com marca, políticas, contato, pagamento e canais oficiais como campos editáveis.

## SEO, performance e integração futura
- [x] Incluir título, descrição, Open Graph básico e manifesto de rotas em `/manus-routes.json`.
- [x] Usar lazy loading nas imagens abaixo da primeira dobra e manter os assets preparados para web.
- [x] Preparar eventos para visualização do hero, clique de CTA, seleção de edição, adicionar ao carrinho, início do checkout e compra concluída.
- [x] Implementar CTA sticky no mobile depois do hero, fechável pelo visitante.
- [ ] Substituir os fallbacks pelos arquivos reais `hero_autor_livro.png` e `editorial_autor_livro.png` quando o cliente os disponibilizar no projeto.
- [ ] Substituir todos os campos entre colchetes pelas informações reais do WooCommerce, autor, envio, entrega, pagamento, suporte e canais oficiais.
