var c1_00 = "Demonstra desconhecimento da modalidade escrita formal da língua portuguesa.";
var c1_40 = "Demonstra domínio precário da modalidade escrita formal da língua portuguesa, de forma sistemática, com diversificados e frequentes desvios gramaticais, de escolha de registro e de convenções da escrita.";
var c1_80 = "Demonstra domínio insuficiente da modalidade escrita formal da língua portuguesa, com muitos desvios gramaticais, de escolha de registro e deconvenções da escrita.";
var c1_120 = "Demonstra domínio mediano da modalidade escrita formal da língua portuguesa e de escolha de registro, com alguns desvios gramaticais e de convenções da escrita.";
var c1_160 = "Demonstra bom domínio da modalidade escrita formal da língua portuguesa e de escolha de registro, com poucos desvios gramaticais e de convenções da escrita.";
var c1_200 = "Demonstra excelente domínio da modalidade escrita formal da língua portuguesa e de escolha de registro. Desvios gramaticais ou de convenções da escrita serão aceitos somente como excepcionalidade e quando não caracterizarem reincidência.";

var c2_00 = "Fuga ao tema/não atendimento à estrutura dissertativo-argumentativa. Nestes casos a redação recebe nota zero e é anulada.";
var c2_40 = "Apresenta o assunto, tangenciando o tema, ou demonstra domínio precário do texto dissertativo-argumentativo, com traços constantes de outros tipos textuais.";
var c2_80 = "Desenvolve o tema recorrendo à cópia de trechos dos textos motivadores ou apresenta domínio insuficiente do texto dissertativo-argumentativo, não atendendo à estrutura com proposição, argumentação e conclusão.";
var c2_120 = "Desenvolve o tema por meio de argumentação previsível e apresenta domínio mediano do texto dissertativo-argumentativo, com proposição, argumentação e conclusão.";
var c2_160 = "Desenvolve o tema por meio de argumentação consistente e apresenta bom domínio do texto dissertativo-argumentativo, com proposição, argumentação e conclusão.";
var c2_200 = "Desenvolve o tema por meio de argumentação consistente, a partir de um repertório sociocultural produtivo, e apresenta excelente domínio do texto dissertativo-argumentativo.";

var c3_00 = "Apresenta informações, fatos e opiniões não relacionados ao tema e sem defesa de um ponto de vista.";
var c3_40 = "Apresenta informações, fatos e opiniões pouco relacionados ao tema ou incoerentes e sem defesa de um ponto de vista.";
var c3_80 = "Apresenta informações, fatos e opiniões relacionados ao tema, mas desorganizados ou contraditórios e limitados aos argumentos dos textos motivadores, em defesa de um ponto de vista.";
var c3_120 = "Apresenta informações, fatos e opiniões relacionados ao tema, limitados aos argumentos dos textos motivadores e pouco organizados, em defesa de um ponto de vista.";
var c3_160 = "Apresenta informações, fatos e opiniões relacionados ao tema, de forma organizada, com indícios de autoria, em defesa de um ponto de vista.";
var c3_200 = "Apresenta informações, fatos e opiniões relacionados ao tema proposto, de forma consistente e organizada, configurando autoria, em defesa de um ponto de vista.";

var c4_00 = "Não articula as informações";
var c4_40 = "Articula as partes do texto de forma precária.";
var c4_80 = "Articula as partes do texto, de forma insuficiente, com muitas inadequações, e apresenta repertório limitado de recursos coesivos.";
var c4_120 = "Articula as partes do texto, de forma mediana, com inadequações, e apresenta repertório pouco diversificado de recursos coesivos.";
var c4_160 = "Articula as partes do texto, com poucas inadequações, e apresenta repertório diversificado de recursos coesivos.";
var c4_200 = "Articula bem as partes do texto e apresenta repertório diversificado de recursos coesivos.";

var c5_00 = "Não apresenta proposta de intervenço ou apresenta proposta não relacionada ao tema ou ao assunto.";
var c5_40 = "Apresenta proposta de intervenção vaga, precária ou relacionada apenas ao assunto.";
var c5_80 = "Elabora, de forma insuficiente, proposta de intervenção relacionada ao tema, ou não articulada com a discussão desenvolvida no texto.";
var c5_120 = "Elabora, de forma mediana, proposta de intervenção relacionada ao tema e articulada à discussão desenvolvida no texto.";
var c5_160 = "Elabora bem proposta de intervenção relacionada ao tema e articulada à discussão desenvolvida no texto.";
var c5_200 = "Elabora muito bem proposta de intervenção, detalhada, relacionada ao tema e articulada à discussão desenvolvida no texto.";

var textos_c1 = {
    "c1_00": c1_00,
    "c1_40": c1_40,
    "c1_80": c1_80,
    "c1_120": c1_120,
    "c1_160": c1_160,
    "c1_200": c1_200
};
var textos_c2 = {
    "c2_00": c2_00,
    "c2_40": c2_40,
    "c2_80": c2_80,
    "c2_120": c2_120,
    "c2_160": c2_160,
    "c2_200": c2_200
};
var textos_c3 = {
    "c3_00": c3_00,
    "c3_40": c3_40,
    "c3_80": c3_80,
    "c3_120": c3_120,
    "c3_160": c3_160,
    "c3_200": c3_200
};
var textos_c4 = {
    "c4_00": c4_00,
    "c4_40": c4_40,
    "c4_80": c4_80,
    "c4_120": c4_120,
    "c4_160": c4_160,
    "c4_200": c4_200
};
var textos_c5 = {
    "c5_00": c5_00,
    "c5_40": c5_40,
    "c5_80": c5_80,
    "c5_120": c5_120,
    "c5_160": c5_160,
    "c5_200": c5_200
};


function pega_texto(event) {
    event.preventDefault(); // previne envio do formulário
    event.stopPropagation(); // evita qualquer propagação do clique

    for (i = 1; i <= 5; i++) {
        const inputSelecionado = document.querySelector(`input[name="c${i}"]:checked`);
        if (inputSelecionado) {
            const id = inputSelecionado.id;
            texto = "";

            switch (i) {
                case 1:
                    texto = textos_c1[id];
                    break;
                case 2:
                    texto = textos_c2[id];
                    break;
                case 3:
                    texto = textos_c3[id];
                    break;
                case 4:
                    texto = textos_c4[id];
                    break;
                case 5:
                    texto = textos_c5[id];
                    break;
            }
            document.getElementById(`com_c${i}`).value = texto;
        }    
    }
}

const comps = document.querySelectorAll('input[type="radio"]');
comps.forEach(comp => {
    comp.addEventListener('change', pega_texto);
});

