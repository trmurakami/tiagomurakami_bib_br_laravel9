<script>

import axios from 'axios';
export default {
  data() {
    return {
        csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        validation: {
            titulo: 'is-invalid',
            autor_nome: 'is-invalid',
            autor_sobrenome: 'is-invalid',
            assuntos: 'is-invalid',
            folhas: 'is-invalid',
            grau: 'is-invalid',
            instituicao: 'is-invalid',
            nome_orientador: 'is-invalid',
            sobrenome_orientador: 'is-invalid',
        },
        cutter: {
            codigo: 'A000',
        },
        record: {
            genero_orientador: "Orientador",
            genero_coorientador: "Coorientador",
            ano: "2024",
            assuntos: [],
            assuntos_string: "",
            cidade: "",
            coorientador: "",
            especializacao: "",
            especializacao_string: "",
            folhas: 0,
            graduacao: "",
            graduacao_string: "",
            grau: "",
            ilustrado: "",
            instituicao: "",
            nome: "",
            nome_orientador: "",
            nome_coorientador: "",
            ppg: "",
            ppg_string: "",
            sobrenome: "",
            sobrenome_orientador: "",
            sobrenome_coorientador: "",
            titulo: "Título do trabalho",
        },
        record_test: {
            genero_orientador: "Orientadora",
            genero_coorientador: "Coorientador",
            ano: "2006",
            assuntos: ['Tesauros', 'World Wide Web'],
            assuntos_string: "1. Tesauros. 2. World Wide Web.",
            cidade: "",
            coorientador: "",
            especializacao: "",
            especializacao_string: "",
            folhas: 92,
            graduacao: "Biblioteconomia",
            graduacao_string: "Bacharel em Biblioteconomia",
            grau: "Trabalho de conclusão de curso (graduação)",
            ilustrado: " : il.",
            instituicao: "Universidade de São Paulo. Escola de Comunicações e Artes",
            nome: "Tiago Rodrigo Marçal",
            nome_orientador: "Sueli Mara Soares Pinto",
            nome_coorientador: "",
            ppg: "",
            ppg_string: "",
            sobrenome: "Murakami",
            sobrenome_orientador: "Ferreira",
            sobrenome_coorientador: "",
            titulo: "Tesauros e a World Wide Web",
        },
        copySuccessful: false,
        errors: null
    }
  },
  computed: {
            complete_record: function() {
                return '\n' + this.record.sobrenome + ', ' + this.record.nome + '\n' +
                this.cutter.codigo + this.record.titulo[0].toLowerCase() + '      ' +
                this.record.titulo + ' / ' + this.record.nome + ' ' + this.record.sobrenome + 
                ' — ' + this.record.ano + '\n' +
                this.record.folhas + ' f.'+ this.record.ilustrado + '\n' +
                '\n' +
                this.record.genero_orientador + ': ' + this.record.nome_orientador + ' ' + this.record.sobrenome_orientador + '.\n' +
                this.record.coorientador +
                this.record.grau + ' — ' + this.record.instituicao + ', ' + this.record.graduacao_string + this.record.ppg_string + this.record.especializacao + ', ' + this.record.ano + '.\n' +
                '\n' +
                this.record.assuntos_string + 
                ' I. ' + this.record.sobrenome_orientador + ', ' +  this.record.nome_orientador + ', orient. II. ' + this.record.titulo + '.\n' +
                '\n'

            }
  },
    mounted() {
        this.validate();
    },
    watch: {
        'record.nome_coorientador': function() {
            this.preencherCoorientador();
        },
        'record.sobrenome_coorientador': function() {
            this.preencherCoorientador();
        },
        'record.graduacao': function() {
            this.preencherGraduacaoString();
        },
        'record.ppg': function() {
            this.preencherPPGString();
        }
    },
        methods: {
            addField: function(field) {
                if (this.record[field] === null) {
                    this.record[field] = [];
                }
                switch (field) {
                    case "corporate_name":
                        this.record[field].push({
                            ind1: "2",
                            a: ""
                        });
                        break;
                    default:
                        this.record[field].push({
                            a: ""
                        });
                }
            },
            cleanAll() {
                document.location.reload(true);
            },
            async copy() {
                try {
                    var successful = navigator.clipboard.writeText(this.complete_record);
                    var msg = successful ? 'successful' : 'unsuccessful';
                    this.copySuccessful = true
                    setTimeout(() => {
                        this.copySuccessful = false;
                    }, 2000);
                } catch (err) {
                    alert('Oops, unable to copy');
                }
            },
            deleteField: function(field, index) {
                this.record[field].splice(index, 1);
            },
            example() {
                this.record = this.record_test;
                this.cutter.codigo = 'M972';
                this.validate();
            },
            gerarStringAssuntos() {
                let strAssuntos = '';
                for (let i = 0; i < this.record.assuntos.length; i++) {
                    strAssuntos += (i + 1) + '. ' + this.record.assuntos[i] + '. ';
                }
                this.record.assuntos_string = strAssuntos;
            },
            getCutter() {
                axios.get('/api/cutter', {
                    params: {
                        search: this.record.sobrenome.toLowerCase().replaceAll(',', '')
                    }
                }).then(response => {
                    this.cutter = response.data;
                });
            },
            preencherCoorientador() {
                if (this.record.nome_coorientador && this.record.sobrenome_coorientador) {
                    this.record.coorientador = this.record.genero_coorientador + ': ' + this.record.nome_coorientador + ' ' + this.record.sobrenome_coorientador + '.\n';
                }
            },
            preencherGraduacaoString() {
                if (this.record.graduacao) {
                    this.record.graduacao_string = 'Bacharel em ' + this.record.graduacao;
                }
            },
            preencherPPGString() {
                if (this.record.ppg) {
                    this.record.ppg_string = 'Programa de Pós-Graduação em ' + this.record.ppg;
                }
            },
            toggleGeneroOrientador() {
                this.record.genero_orientador = this.record.genero_orientador === 'Orientador' ? 'Orientadora' : 'Orientador';
            },
            toggleGeneroCoorientador() {
                this.record.genero_coorientador = this.record.genero_coorientador === 'Coorientador' ? 'Coorientadora' : 'Coorientador';
            },
            toggleIlustrado() {
                this.record.ilustrado = this.record.ilustrado === '' ? ' : il.' : '';
            },
            validate() {
                this.errors = null;
                if (this.record.titulo == "") {
                    this.validation.titulo = "is-invalid";
                    if (this.errors == null) {
                        this.errors = [];
                    }
                    this.errors.push({
                        message: 'Título é obrigatório'
                    });
                } else if (this.record.titulo == "Título do trabalho") {
                    this.validation.titulo = "is-invalid";
                    if (this.errors == null) {
                        this.errors = [];
                    }
                    this.errors.push({
                        message: 'Título de exemplo não foi alterado'
                    });
                } else {
                    this.validation.titulo = "is-valid";
                }
                if (this.record.nome == "") {
                    this.validation.autor_nome = "is-invalid";
                    if (this.errors == null) {
                        this.errors = [];
                    }
                    this.errors.push({
                        message: 'Nome do autor é obrigatório'
                    });
                } else {
                    this.validation.autor_nome = "is-valid";
                }
                if (this.record.sobrenome == "") {
                    this.validation.autor_sobrenome = "is-invalid";
                    if (this.errors == null) {
                        this.errors = [];
                    }
                    this.errors.push({
                        message: 'Sobrenome do autor é obrigatório'
                    });
                } else {
                    this.validation.autor_sobrenome = "is-valid";
                }
                if (this.record.nome_orientador == "") {
                    this.validation.nome_orientador = "is-invalid";
                    if (this.errors == null) {
                        this.errors = [];
                    }
                    this.errors.push({
                        message: 'Nome do orientador é obrigatório'
                    });
                } else {
                    this.validation.nome_orientador = "is-valid";
                }
                if (this.record.sobrenome_orientador == "") {
                    this.validation.sobrenome_orientador = "is-invalid";
                    if (this.errors == null) {
                        this.errors = [];
                    }
                    this.errors.push({
                        message: 'Sobrenome do orientador é obrigatório'
                    });
                } else {
                    this.validation.sobrenome_orientador = "is-valid";
                }
                if (this.record.instituicao == "") {
                    this.validation.instituicao = "is-invalid";
                    if (this.errors == null) {
                        this.errors = [];
                    }
                    this.errors.push({
                        message: 'Nome da instituição é obrigatório'
                    });
                } else {
                    this.validation.instituicao = "is-valid";
                }
                if (this.record.grau == "") {
                    this.validation.grau = "is-invalid";
                    if (this.errors == null) {
                        this.errors = [];
                    }
                    this.errors.push({
                        message: 'Grau acadêmico é obrigatório'
                    });
                } else {
                    this.validation.grau = "is-valid";
                }
                if (!this.record.assuntos || !this.record.assuntos[0]) {
                    this.validation.assuntos = "is-invalid";
                    if (this.errors == null) {
                        this.errors = [];
                    }
                    this.errors.push({
                        message: 'O primeiro assunto é obrigatório'
                    });
                } else {
                    this.validation.assuntos = "is-valid";
                }
                if (this.record.folhas == 0) {
                    this.validation.folhas = "is-invalid";
                    if (this.errors == null) {
                        this.errors = [];
                    }
                    this.errors.push({
                        message: 'O número de folhas não foi informado'
                    });
                } else {
                    this.validation.folhas = "is-valid";
                }
            }
        }
}
</script>

<template>

    <div class="container-fluid">
        <div class="row" id="editor">
            <main class="col-md-12 ms-sm-auto col-lg-12 px-md-4">
                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Gerador de ficha catalográfica para trabalhos acadêmicos</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2">
                            <button type="button" class="btn btn-sm btn-outline-secondary" @click="example()">Preencher registro de exemplo</button>
                            <button type="button" class="btn btn-sm btn-outline-warning"
                                @click="validate()">Validar</button>
                            <button type="button" class="btn btn-sm btn-outline-secondary" @click="cleanAll()">Reiniciar</button>
                            <!--
            <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
            -->
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 ms-sm-auto col-lg-6">

                        <!-- Autor -->
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="autor">Autor</span>
                            <input type="text" id="nome" v-model="record.nome" class="form-control"
                                placeholder="Nome" aria-label="Nome"
                                aria-describedby="Nome" :class="validation.autor_nome" @input="validate()">
                            <input type="text" id="sobrenome" v-model="record.sobrenome" class="form-control"
                                placeholder="Sobrenome" aria-label="Sobrenome"
                                aria-describedby="Sobrenome" @input="getCutter(); validate()" :class="validation.autor_sobrenome">
                        </div>
                        <!-- \Autor -->

                        <!-- Título do trabalho -->
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="titulo">Título do trabalho</span>
                            <input type="text" id="titulo" v-model="record.titulo" class="form-control"
                                placeholder="Título do trabalho" aria-label="Título do trabalho"
                                aria-describedby="titulo" :class="validation.titulo" @input="validate()">
                        </div>
                        <!-- \Título do trabalho -->

                        <!-- Ano do trabalho -->
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="ano">Ano do trabalho</span>
                            <input type="text" id="ano" v-model="record.ano" class="form-control"
                                placeholder="Ano do trabalho" aria-label="Ano do trabalho"
                                aria-describedby="ano">
                        </div>
                        <!-- \Ano do trabalho -->

                        <!-- Número de folhas -->
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="folhas">Número de folhas</span>
                            <input type="text" id="folhas" v-model="record.folhas" class="form-control"
                                placeholder="Número de folhas" aria-label="Número de folhas"
                                aria-describedby="folhas" :class="validation.folhas" @input="validate()">
                        </div>
                        <!-- \Número de folhas -->

                        <!-- Ilustrado -->
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" @input="toggleIlustrado">
                            <label class="form-check-label" for="flexCheckDefault">
                                Ilustrado?
                            </label>
                        </div>
                        <!-- \Ilustrado -->

                        <!-- Orientador -->
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="orientador">{{ record.genero_orientador }}</span>

                            <input type="text" id="nome_orientador" v-model="record.nome_orientador" class="form-control"
                                placeholder="Nome" aria-label="Nome do orientador"
                                aria-describedby="Nome" :class="validation.nome_orientador" @input="validate()">
                            <input type="text" id="sobrenome_orientador" v-model="record.sobrenome_orientador" class="form-control"
                                placeholder="Sobrenome" aria-label="Sobrenome"
                                aria-describedby="Sobrenome" @input="getCutter(); validate()" :class="validation.sobrenome_orientador">
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" @input="toggleGeneroOrientador">
                            <label class="form-check-label" for="flexCheckDefault">
                                Orientadora?
                            </label>
                        </div>
                        <!-- \Orientador -->

                        <!-- Coorientador -->
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="coorientador">{{ record.genero_coorientador }}</span>

                            <input type="text" id="nome_coorientador" v-model="record.nome_coorientador" class="form-control"
                                placeholder="Nome" aria-label="Nome do coorientador"
                                aria-describedby="Nome" :class="validation.nome_coorientador" @input="validate()">
                            <input type="text" id="sobrenome_coorientador" v-model="record.sobrenome_coorientador" class="form-control"
                                placeholder="Sobrenome" aria-label="Sobrenome"
                                aria-describedby="Sobrenome" @input="getCutter(); validate()" :class="validation.sobrenome_coorientador">
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" @input="toggleGeneroCoorientador(); preencherCoorientador()">
                            <label class="form-check-label" for="flexCheckDefault">
                                Coorientadora?
                            </label>
                        </div>
                        <!-- \Coorientador -->

                        <!-- Instituição -->
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="instituicao">Instituição</span>
                            <input type="text" id="instituicao" v-model="record.instituicao" class="form-control"
                                placeholder="Nome da instituição" aria-label="Nome da instituição"
                                aria-describedby="instituicao" :class="validation.instituicao" @input="validate()">
                        </div>
                        <!-- \Instituição -->

                        <!-- Grau acadêmico -->
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="grau">Grau acadêmico</span>
                            <select class="form-select" id="grau" v-model="record.grau" aria-label="Grau acadêmico" @input="validate()" :class="validation.grau">
                                <option value="Trabalho de conclusão de curso (graduação)">Trabalho de conclusão de curso (Graduação)</option>
                                <option value="Trabalho de conclusão de curso (especialização)">Trabalho de conclusão de curso (Especialização)</option>
                                <option value="Dissertação (Mestrado)">Dissertação (Mestrado)</option>
                                <option value="Dissertação (Mestrado Profissional)">Dissertação (Mestrado Profissional)</option>
                                <option value="Tese (Doutorado)">Tese (Doutorado)</option>
                                <option value="Tese de livre-docência">Tese de livre-docência</option>
                            </select>
                        </div>

                        <!-- \Grau acadêmico -->
                        <!-- Programa de Pós Graduação -->
                        <div class="input-group mb-3" v-if="['Dissertação (Mestrado)', 'Dissertação (Mestrado Profissional)', 'Tese (Doutorado)'].includes(record.grau)">
                            <span class="input-group-text" id="ppg">Programa de Pós Graduação</span>
                            <input type="text" id="ppg" v-model="record.ppg" class="form-control"
                                placeholder="Nome do Programa de Pós Graduação" aria-label="Nome do Programa de Pós Graduação"
                                aria-describedby="ppg">
                        </div>
                        <!-- \Programa de Pós Graduação -->
                        <!-- Graduação -->
                        <div class="input-group mb-3" v-if="record.grau == 'Trabalho de conclusão de curso (graduação)'">
                            <span class="input-group-text" id="graduacao">Graduação em</span>
                            <input type="text" id="graduacao" v-model="record.graduacao" class="form-control"
                                placeholder="Graduação em" aria-label="Graduação em"
                                aria-describedby="graduacao">
                        </div>
                        <!-- \Graduação -->
                        <!-- Especialização -->
                        <div class="input-group mb-3" v-if="['Trabalho de conclusão de curso (especialização)'].includes(record.grau)">
                            <span class="input-group-text" id="especializacao">Especialização em</span>
                            <input type="text" id="especializacao" v-model="record.especializacao" class="form-control"
                                placeholder="Especialização em" aria-label="Especialização em"
                                aria-describedby="especializacao">
                        </div>
                        <!-- \Especialização -->


                        <!-- Assuntos -->
                        <!-- Ano do trabalho -->
                        <div class="input-group mb-3">
                            <div class="col-2">
                                <span class="input-group-text" id="assuntos">Assuntos</span>
                            </div>
                            <div class="col-10">
                                <input type="text" id="assunto" v-model="record.assuntos[0]" class="form-control"
                                placeholder="Assunto 1" aria-label="Assunto"
                                aria-describedby="assunto0" @input="validate(); gerarStringAssuntos()" :class="validation.assuntos">
                                <input type="text" id="assunto" v-model="record.assuntos[1]" class="form-control"
                                placeholder="Assunto 2" aria-label="Assunto"
                                aria-describedby="assunto0" @input="gerarStringAssuntos()">
                                <input type="text" id="assunto" v-model="record.assuntos[2]" class="form-control"
                                placeholder="Assunto 3" aria-label="Assunto"
                                aria-describedby="assunto" @input="gerarStringAssuntos()">
                                <input type="text" id="assunto" v-model="record.assuntos[3]" class="form-control"
                                placeholder="Assunto 4" aria-label="Assunto"
                                aria-describedby="assunto" @input="gerarStringAssuntos()">
                                <input type="text" id="assunto" v-model="record.assuntos[4]" class="form-control"
                                placeholder="Assunto 5" aria-label="Assunto"
                                aria-describedby="assunto" @input="gerarStringAssuntos()">
                            </div>

                        </div>
                        <!-- \Ano do trabalho -->

                        <!-- \Assuntos -->


                    </div>
                    <div class="col-md-6 col-lg-6">
                        <h2>Ficha catalográfica</h2>
                        <div class="border p-5" style="font-family: monospace;">
                            <p>{{ this.cutter.codigo + this.record.titulo[0].toLowerCase() }}</p>
                            <p class="p-0 m-0">{{ this.record.sobrenome + ', ' + this.record.nome }}</p>                            
                            <p class="p-0 m-0">&nbsp;&nbsp;&nbsp;&nbsp;{{ this.record.titulo + ' / ' + this.record.nome + ' ' + this.record.sobrenome + ' — ' + this.record.ano }}</p>
                            <p class="p-0 m-0">&nbsp;&nbsp;&nbsp;&nbsp;{{ this.record.folhas + ' f.' + this.record.ilustrado + '\n' }}</p>
                            <br/>
                            <p class="p-0 m-0">&nbsp;&nbsp;&nbsp;&nbsp;{{ this.record.genero_orientador + ': ' + this.record.nome_orientador + ' ' + this.record.sobrenome_orientador + '.' }}</p>
                            <p class="p-0 m-0" v-if="this.record.coorientador.length > 0">&nbsp;&nbsp;&nbsp;&nbsp;{{ this.record.coorientador }}</p>
                            <p class="p-0 m-0">&nbsp;&nbsp;&nbsp;&nbsp;{{ this.record.grau + ' — ' + this.record.instituicao + ', ' + this.record.graduacao_string + this.record.ppg_string + this.record.especializacao + ', ' + this.record.ano + '.' }}</p>
                            <br/>
                            <p class="p-0 m-0">&nbsp;&nbsp;&nbsp;&nbsp;{{ this.record.assuntos_string + ' I. ' + this.record.sobrenome_orientador + ', ' +  this.record.nome_orientador + ', orient. II. ' + this.record.titulo }}</p>
                        </div>
                        <p class="mt-3">
                            <span class="btn btn-info text-white copy-btn ml-auto"
                                @click.stop.prevent="copy">Copiar</span>
                            <input 
                                type="hidden"
                                id="complete_record"
                                :value="complete_record"
                            >

                            <div class="alert alert-info" role="alert" v-if="copySuccessful">
                                Copiado com sucesso!
                            </div>
                        </p>
                        <p>
                            <form action="/export-pdf" method="POST">
                                <input type="hidden" name="_token" :value="csrf" />
                                <input type="hidden" id="titulo" name="titulo" :value="record.titulo">
                                <input type="hidden" id="nome" name="nome" :value="record.nome">
                                <input type="hidden" id="sobrenome" name="sobrenome" :value="record.sobrenome">
                                <input type="hidden" id="ano" name="ano" :value="record.ano">
                                <input type="hidden" id="folhas" name="folhas" :value="record.folhas">
                                <input type="hidden" id="ilustrado" name="ilustrado" :value="record.ilustrado">
                                <input type="hidden" id="genero_orientador" name="genero_orientador" :value="record.genero_orientador">
                                <input type="hidden" id="nome_orientador" name="nome_orientador" :value="record.nome_orientador">
                                <input type="hidden" id="sobrenome_orientador" name="sobrenome_orientador" :value="record.sobrenome_orientador">
                                <input type="hidden" id="genero_coorientador" name="genero_coorientador" :value="record.genero_coorientador">
                                <input type="hidden" id="nome_coorientador" name="nome_coorientador" :value="record.nome_coorientador">
                                <input type="hidden" id="sobrenome_coorientador" name="sobrenome_coorientador" :value="record.sobrenome_coorientador">
                                <input type="hidden" id="instituicao" name="instituicao" :value="record.instituicao">
                                <input type="hidden" id="grau" name="grau" :value="record.grau">
                                <input type="hidden" id="ppg" name="ppg" :value="record.ppg_string">
                                <input type="hidden" id="graduacao" name="graduacao" :value="record.graduacao_string">
                                <input type="hidden" id="especializacao" name="especializacao" :value="record.especializacao">
                                <input type="hidden" id="assuntos" name="assuntos" :value="record.assuntos">
                                <input type="hidden" id="cutter" name="cutter" :value="cutter.codigo">


                                <button type="submit" class="btn btn-success text-white copy-btn ml-auto">Exportar PDF</button>
                            </form>
                        </p>


                        <div class="alert alert-warning mt-5" role="alert" v-if="errors">
                            <h5>Validação</h5>
                            <ul>
                                <li v-for="(error) in errors">{{ error.message }}</li>
                            </ul>
                        </div>

                    </div>


                </div>


            </main>

        </div>
    </div>

</template>