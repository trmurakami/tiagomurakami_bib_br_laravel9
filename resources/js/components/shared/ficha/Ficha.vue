<script>
export default {
  data() {
    return {
        validation: {
            titulo: 'is-invalid',
        },
        cutter: {
            codigo: 'A000',
        },
        record: {
            ano: "2024",
            cidade: "",
            folhas: 0,
            nome: "",
            sobrenome: "",
            titulo: "Título do trabalho",
        },
        copySuccessful: false,
        current_ldr: null,
        loadingDOI: false,
        loadingISBN: false,
        loadingZ3950: false,
        i_personal_name: 1,
        errors: null,
        RDA: false,
        _336b: null,
        _337b: null,
        _338b: null
    }
  },
  computed: {
            complete_record: function() {

                return this.record.sobrenome + ', ' + this.record.nome + '\n' +
                this.cutter.codigo + this.record.titulo[0].toLowerCase() + '      ' +
                this.record.titulo + ' / ' + this.record.nome + ' ' + this.record.sobrenome + 
                ' - ' + this.record.ano + '\n' +
                this.record.folhas + ' f. : il.\n' +
                '\n' +
                'Orientador: Nome do orientador\n' +
                '\n' +
                '\n'

            }
        },
        mounted() {
            this.update005();
            this.translation = this.translation_en_US;
        },
        methods: {
            addField: function(field) {
                if (this.record[field] === null) {
                    this.record[field] = [];
                }
                switch (field) {
                    case "isbn":
                        this.record[field].push({
                            id: ""
                        });
                        break;
                    case "personal_name":
                        this.record[field].push({
                            ind1: "1",
                            a: "",
                            d: null,
                            q: null
                        });
                        break;
                    case "corporate_name":
                        this.record[field].push({
                            ind1: "2",
                            a: ""
                        });
                        break;
                    case "_650":
                        this.record[field].push({
                            ind1: "0",
                            ind2: "4",
                            a: "",
                            _2: ""
                        });
                        break;
                    case "_856":
                        this.record[field].push({
                            ind1: "4",
                            ind2: "0",
                            u: ""
                        });
                        break;
                    case "general_note":
                        this.record[field].push({
                            a: ""
                        });
                        break;
                    case "_536":
                        this.record[field].push({
                            a: "",
                            f: ""
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
            getCutter() {
                axios.get('/api/cutter', {
                    params: {
                        search: this.record.sobrenome.toLowerCase().replaceAll(',', '')
                    }
                }).then(response => {
                    this.cutter = response.data;
                });
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
                if (this.record.f008.p07_10.length != 4) {
                    if (this.errors == null) {
                        this.errors = [];
                    }
                    this.errors.push({
                        message: '008 position 07-10 has invalid length (4 is mandatory)'
                    });
                }
                if (isNaN(this.record.f008.p07_10)) {
                    if (this.errors == null) {
                        this.errors = [];
                    }
                    this.errors.push({
                        message: '008 position 07-10 is not a valid number'
                    });
                }
                if (this.record.f008.p07_10 == '0000') {
                    if (this.errors == null) {
                        this.errors = [];
                    }
                    this.errors.push({
                        message: '008 position 07-10 is not a valid number'
                    });
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
                    <div class="col-md-8 ms-sm-auto col-lg-8 px-md-4">

                        <!-- Autor -->
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="autor">Autor</span>
                            <input type="text" id="nome" v-model="record.nome" class="form-control"
                                placeholder="Nome" aria-label="Nome"
                                aria-describedby="Nome">
                            <input type="text" id="sobrenome" v-model="record.sobrenome" class="form-control"
                                placeholder="Sobrenome" aria-label="Sobrenome"
                                aria-describedby="Sobrenome" @input="getCutter">
                        </div>
                        <!-- \Autor -->

                        <!-- Título do trabalho -->
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="titulo">Título do trabalho</span>
                            <input type="text" id="titulo" v-model="record.titulo" class="form-control"
                                placeholder="Título do trabalho" aria-label="Título do trabalho"
                                aria-describedby="titulo" :class="validation.titulo" @input="validate">
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

                        <!-- Ano do trabalho -->
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="folhas">Número de folhas</span>
                            <input type="text" id="folhas" v-model="record.folhas" class="form-control"
                                placeholder="Número de folhas" aria-label="Número de folhas"
                                aria-describedby="folhas">
                        </div>
                        <!-- \Ano do trabalho -->


                    </div>
                    <div class="col-md-4 col-lg-4">
                        <h2>Ficha catalográfica</h2>
                        <pre>
                            {{ complete_record }}
                        </pre>
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
                        <div class="alert alert-warning mt-5" role="alert" v-if="errors">
                            <h5>{{ translation.warning }}</h5>
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