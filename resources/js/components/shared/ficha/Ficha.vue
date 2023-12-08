<script>
export default {
  data() {
    return {
        validation: {
            titulo: 'is-invalid',
            autor_nome: 'is-invalid',
            autor_sobrenome: 'is-invalid',
            instituicao: 'is-invalid',
            nome_orientador: 'is-invalid',
            sobrenome_orientador: 'is-invalid',
        },
        cutter: {
            codigo: 'A000',
        },
        record: {
            genero_orientador: "Orientador",
            ano: "2024",
            cidade: "",
            folhas: 0,
            instituicao: "",
            nome: "",
            nome_orientador: "",
            sobrenome: "",
            sobrenome_orientador: "",
            titulo: "Título do trabalho",
        },
        copySuccessful: false,
        errors: null
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
                this.record.genero_orientador + ': ' + this.record.nome_orientador + ' ' + this.record.sobrenome_orientador + '.\n' +
                ' - ' + this.record.instituicao + ', ' + this.record.ano + '.\n' +
                '\n' +
                'I.' + this.record.sobrenome_orientador + ', ' +  this.record.nome_orientador + ', orient. II.' + this.record.titulo + '.\n' +
                '\n'

            }
        },
        mounted() {
            this.validate();
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
            getCutter() {
                axios.get('/api/cutter', {
                    params: {
                        search: this.record.sobrenome.toLowerCase().replaceAll(',', '')
                    }
                }).then(response => {
                    this.cutter = response.data;
                });
            },
            toggleGeneroOrientador() {
                this.record.genero_orientador = this.record.genero_orientador === 'Orientador' ? 'Orientadora' : 'Orientador';
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

                        <!-- Ano do trabalho -->
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="folhas">Número de folhas</span>
                            <input type="text" id="folhas" v-model="record.folhas" class="form-control"
                                placeholder="Número de folhas" aria-label="Número de folhas"
                                aria-describedby="folhas">
                        </div>
                        <!-- \Ano do trabalho -->

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

                        <!-- Instituição -->
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="instituicao">Instituição</span>
                            <input type="text" id="instituicao" v-model="record.instituicao" class="form-control"
                                placeholder="Nome da instituição" aria-label="Nome da instituição"
                                aria-describedby="instituicao" :class="validation.instituicao" @input="validate()">
                        </div>
                        <!-- \Instituição -->


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