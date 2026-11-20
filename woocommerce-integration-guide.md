# Guia de Implementação e Integração WordPress & WooCommerce
## Livro: “O Pacto de 1 Bilhão” — Autor: Salih Abdulatif

---

### 1. Visão Geral do Projeto
Esta landing page foi desenvolvida sob uma **direção de arte editorial premium e princípios avançados de CRO (Conversion Rate Optimization)**. O layout foge deliberadamente dos clichês de infoprodutos agressivos, inteligência artificial genérica ou templates pré-fabricados, posicionando a obra com o prestígio visual e a sobriedade característicos do mercado editorial e de grandes biografias de negócios.

- **Título**: O Pacto de 1 Bilhão
- **Autor**: Salih Abdulatif
- **Formatos**: Livro Físico e Livro Digital (e-book)
- **Tecnologias**: HTML5 Semântico, CSS3 Moderno (Custom Properties & Grid/Flexbox), JavaScript Vanilla (Zero dependências externas além do Google Fonts) e PHP nativo para WordPress/WooCommerce.
- **Tipografia**:
  - Títulos Editoriais: `Lora` (Serif de alto contraste, a mesma utilizada na capa oficial)
  - UI, Botões e Metadados: `Montserrat` (Sans-serif geométrica e assertiva)
  - Textos de Apoio e Leitura: `Lato` (Sans-serif humanista de excelente legibilidade)
- **Paleta Cromática**:
  - Azul-Marinho Profundo: `#060B14`, `#0B1325`, `#101B33`
  - Grafite e Ardósia: `#1E2838`, `#334155`, `#64748B`
  - Marfim e Branco Quente: `#FAF8F5`, `#FFFFFF`, `#F2EFE9`
  - Champagne e Ouro Acetinado: `#C9A86A`, `#DFCA9B`, `#9D7B38`

---

### 2. Arquivos do Projeto

| Arquivo | Descrição |
| :--- | :--- |
| `index.html` | Página estática completa para teste local em qualquer navegador e prototipação direta. |
| `style.css` | Folha de estilos completa, responsiva (360px a 1440px+), com animações sutis e variáveis de design. |
| `script.js` | Comportamentos interativos: acordeão acessível de FAQ, sticky CTA mobile, rolagem suave e envio de eventos para o `dataLayer` (GA4 / GTM). |
| `page-o-pacto-de-1-bilhao.php` | Modelo de página (Page Template) pronto para instalação direta em qualquer tema WordPress com suporte a WooCommerce. |
| `hero_autor_livro.png` | Asset oficial horizontal 16:9 utilizado na primeira dobra. |
| `editorial_autor_livro.png` | Asset oficial vertical 4:5 utilizado na seção de autoridade do autor. |

---

### 3. Como Publicar no WordPress com WooCommerce

#### Opção A: Utilizando como Modelo de Página (Recomendado)
1. Conecte-se ao seu servidor WordPress via FTP ou Gerenciador de Arquivos do cPanel/Hospedagem.
2. Acesse a pasta do seu tema filho (child theme) ou tema ativo:
   `wp-content/themes/seu-tema-filho/`
3. Envie os seguintes arquivos para a pasta do tema:
   - `page-o-pacto-de-1-bilhao.php`
   - `style.css` (ou incorpore os estilos ao CSS do tema)
   - `script.js`
   - `hero_autor_livro.png`
   - `editorial_autor_livro.png`
4. No painel do WordPress, vá em **Páginas > Adicionar Nova**.
5. No painel lateral direito, em **Modelo de Página (Page Template)**, selecione:
   **`Landing Page - O Pacto de 1 Bilhão`**.
6. Defina o slug/URL da página (ex: `o-pacto-de-1-bilhao` ou `livro`) e clique em **Publicar**.

#### Opção B: Configuração dos IDs dos Produtos no WooCommerce
No arquivo `page-o-pacto-de-1-bilhao.php`, localize as linhas:
```php
$id_produto_fisico  = apply_filters('pacto_produto_fisico_id', 101);
$id_produto_digital = apply_filters('pacto_produto_digital_id', 102);
```
Substitua `101` pelo ID real do produto físico cadastrado no seu WooCommerce e `102` pelo ID real da edição digital.

**Como descobrir o ID do produto no WooCommerce:**
1. No painel WordPress, acesse **Produtos > Todos os produtos**.
2. Passe o cursor sobre o produto desejado; o ID numérico será exibido logo abaixo do título (ex: `ID: 245`).

#### Opção C: Redirecionamento Direto para o Checkout
Para máxima conversão, o link de compra pode enviar o cliente diretamente para a página de checkout já com o item adicionado ao carrinho:
- Link Edição Física: `https://seusite.com.br/checkout/?add-to-cart=ID_DO_PRODUTO_FISICO`
- Link Edição Digital: `https://seusite.com.br/checkout/?add-to-cart=ID_DO_PRODUTO_DIGITAL`

---

### 4. Rastreamento e Analytics (GA4 e Google Tag Manager)
O arquivo `script.js` já possui hooks nativos para o `window.dataLayer`, disparando os eventos fundamentais do funil de e-commerce:

1. **`view_hero`**: Disparado assim que a página é carregada, identificando a visualização da primeira dobra.
2. **`cta_click`**: Registra cliques nos botões de navegação e descoberta (`cta_hero_comprar`, `cta_hero_conhecer`, `cta_final_escolher`).
3. **`add_to_cart`**: Disparado ao clicar nos botões de compra, transmitindo:
   - `currency`: 'BRL'
   - `value`: Preço do livro
   - `item_id`: ID do produto
   - `item_name`: Nome da edição
4. **`faq_opened`**: Monitora quais dúvidas os visitantes mais expandem para ajudar na melhoria contínua da copy.

---

### 5. Boas Práticas e Diretrizes de CRO Aplicadas
- **Hierarquia Visual Estrita**: O olho do visitante percorre naturalmente: Título Editorial > Proposta de Valor > Visual com Autor e Livro > CTA Claro.
- **Transparência e Credibilidade**: Sem contadores regressivos falsos, sem pop-ups intrusivos e sem depoimentos forjados.
- **Microprova de Segurança**: Ícones lineares discretos abaixo do CTA reforçam compra segura e entrega oficial.
- **Sticky CTA Mobile**: Em smartphones, ao rolar além do Hero, uma barra fina e elegante surge no rodapé com o botão "GARANTIR", acompanhada de um botão de fechamento caso o leitor prefira dispensá-la.
- **Performance**: As imagens utilizam lazy loading abaixo da primeira dobra (`loading="lazy"`) e prioridade de carregamento no Hero (`fetchpriority="high"`).
