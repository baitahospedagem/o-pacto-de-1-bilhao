# O Pacto de 1 Bilhão — Tema WordPress & Loja WooCommerce Oficial

> **Autor:** Salih Abdulatif  
> **Tema:** O Pacto de 1 Bilhão  
> **Tecnologias:** WordPress 6.x+, WooCommerce 8.x+, PHP 7.4+, CSS3, JavaScript Vanilla, HTML5 Semântico  

---

## 🌟 Visão Geral

Este repositório contém a infraestrutura completa do tema oficial **O Pacto de 1 Bilhão**, desenvolvido sob direção de arte editorial premium de negócios e princípios avançados de CRO (Conversion Rate Optimization).

O projeto é 100% compatível com **WooCommerce**, permitindo vender tanto a **Edição Física** (com cálculo automático de frete e controle de estoque) quanto a **Edição Digital** (download automático de e-book/PDF após confirmação do pagamento via PIX ou Cartão).

---

## 📦 Estrutura do Pacote de Temas

O projeto inclui o **Tema Pai (Parent Theme)** e o **Tema Filho (Child Theme)**:

1. **`o-pacto-de-1-bilhao.zip`**: Arquivo de instalação rápida do Tema Principal.
2. **`o-pacto-de-1-bilhao-child.zip`**: Arquivo de instalação do Tema Filho (recomendado para manter personalizações e atualizações seguras).
3. **`themes/o-pacto-de-1-bilhao/`**: Pasta com o código-fonte completo do tema pai.
4. **`themes/o-pacto-de-1-bilhao-child/`**: Pasta com o código-fonte do tema filho.
5. **`index.html`**: Versão estática completa para testes locais e prototipagem offline.

---

## 🚀 Como Instalar no WordPress

### Passo 1: Instalar o WooCommerce (se ainda não tiver)
1. No painel do WordPress, vá em **Plugins > Adicionar Novo**.
2. Pesquise por **WooCommerce** e clique em **Instalar Agora** e depois em **Ativar**.

### Passo 2: Instalar o Tema Principal (Parent Theme)
1. No painel do WordPress, vá em **Aparência > Temas > Adicionar Novo > Enviar Tema**.
2. Selecione o arquivo **`o-pacto-de-1-bilhao.zip`** e clique em **Instalar Agora**.
3. *(Não precisa ativar ainda, ative o tema filho no próximo passo)*.

### Passo 3: Instalar e Ativar o Tema Filho (Child Theme)
1. Vá novamente em **Aparência > Temas > Adicionar Novo > Enviar Tema**.
2. Selecione o arquivo **`o-pacto-de-1-bilhao-child.zip`** e clique em **Instalar Agora**.
3. Clique em **Ativar**.

---

## ⚙️ Configuração da Loja & Produtos

### 1. Cadastrar os Produtos no WooCommerce
No painel do WordPress, acesse **Produtos > Adicionar Novo**:

- **Edição Física**:
  - Tipo: **Produto simples**
  - Nome: *O Pacto de 1 Bilhão — Edição Oficial Capa Dura*
  - Preço normal: `R$ 69,00` | Preço promocional: `R$ 59,00`
  - Aba **Entrega**: Preencha peso e dimensões para o frete dos Correios/Melhor Envio.
  - Guarde o **ID do Produto** (ex: `101`).

- **Edição Digital (E-book)**:
  - Tipo: **Produto simples**
  - Marque as caixas: `[x] Virtual` e `[x] Para download`
  - Nome: *O Pacto de 1 Bilhão — Edição Digital (E-book)*
  - Preço normal: `R$ 39,00` | Preço promocional: `R$ 29,00`
  - Aba **Geral**: Anexe o arquivo PDF/ePub para download automático após a compra.
  - Guarde o **ID do Produto** (ex: `102`).

### 2. Vincular os Produtos ao Tema
1. Vá em **Aparência > Personalizar > O Pacto de 1 Bilhão — Loja & Produtos**.
2. Preencha:
   - **ID do Produto Físico (WooCommerce)**: Ex: `101`
   - **ID do Produto Digital (WooCommerce)**: Ex: `102`
   - **Link da Edição Amazon Kindle**: URL do seu livro na Amazon.
   - **Redirecionar direto para o Checkout**: Ative para máxima taxa de conversão (pula o carrinho e vai direto para pagamento).
   - **WhatsApp & E-mail de Suporte**: Seus dados de atendimento ao cliente.
3. Clique em **Publicar**.

---

## 📄 Definir a Página Inicial Oficial

1. Vá em **Páginas > Adicionar Nova**.
2. Dê o título de **Início** ou **Home**.
3. Na barra lateral direita, em **Modelo de Página**, escolha **Landing Page - O Pacto de 1 Bilhão** (ou deixe o padrão, pois `front-page.php` já renderiza o layout oficial).
4. Clique em **Publicar**.
5. Em seguida, acesse **Configurações > Leitura**:
   - Em **Sua página inicial exibe**, selecione **Uma página estática**.
   - **Página inicial**: Escolha a página **Início** que acabou de criar.
   - Clique em **Salvar alterações**.

---

## 💳 Formas de Pagamento Recomendadas (Brasil)
- **Mercado Pago para WooCommerce**: PIX com aprovação instantânea, Cartão de Crédito e Boleto.
- **Stripe**: Pagamentos internacionais e nacionais no cartão.
- **Melhor Envio / Correios**: Cálculo automático de prazo e frete.

---

## 🎨 Recursos de Alta Conversão Inclusos
- **Animação 3D interativa do livro** acionada por scroll suave com controle inteligente de viewport.
- **Sticky CTA Mobile** para compra ágil no smartphone.
- **Carrossel responsivo de avaliações e depoimentos**.
- **Cards de preços com precificação dinâmica** diretamente sincronizada com o catálogo do WooCommerce.
- **Favicon oficial** pré-configurado em todas as resoluções (desktop, mobile e Apple touch icon).

---
© Salih Abdulatif. Todos os direitos reservados.
