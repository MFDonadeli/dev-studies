# Normal

v-for
v-if e v-else
@events

# Component

Product: Tem imagem, título, em estoque ou não, lista de detalhes, div de cores, botão add to cart e product-tab
Product-tab: tabs de review / formulario, review lista e formulario (product-review)
Product-review: Formulário e botão de submit

Quando clica o submit de product-review, ele emite 'review-submitted' ao event bus, este evento é recebido em product, dentro de mounted e coloca na lista de reviews.

