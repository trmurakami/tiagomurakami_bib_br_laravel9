<script>
export default {
  data() {
    return {
        validation: {
            _245a: '',
        },
        crossrefRecord: null,
        ISBNRecord: null,
        Z3950Records: null,
        recordType: 'Book',
        translation: [],
        translation_en_US: {
            _008: '008 - Fixed-Length Data Elements-General Information',
            _040a: 'Original cataloging agency',
            _040c: 'Transcribing agency',
            _245: 'Title statement',
            _2451: 'Title added entry',
            _24510: 'No added entry',
            _24511: 'Added entry',
            _2452: 'Nonfiling characters',
            _245a: 'Title',
            _245b: 'Remainder of title',
            _245c: 'Statement of responsibility, etc.',
            _260: 'Imprint',
            _2601: 'Sequence of publishing statements',
            _2601_: '# - Not applicable/No information provided/Earliest available publisher',
            _26012: '2 - Intervening publisher',
            _26013: '3 - Current/latest publisher',
            _260a: 'Place of publication',
            _260b: 'Name of publisher',
            _260c: 'Date of publication',
            _300: 'Physical Description',
            _300a: 'Extent',
            _300b: 'Other physical details',
            _300c: 'Dimensions',
            add_corporate_name:'Add Corporate Name',
            add_eletronic_location_and_access: 'Add Electronic Location and Access',
            add_general_note: 'Add General Note',
            add_isbn: 'Add ISBN',
            add_personal_name: 'Add Personal Name',
            add_rda_fields: 'Add RDA fields (336, 337, 338)',
            add_subject_added_entry_topical_term: 'Add Subject Added Entry-Topical Term',
            affiliation: 'Affiliation',
            book: 'Book',
            cataloging_source: 'Cataloging Source',
            clear_all_record: 'Clear all record',
            clear_validation: 'Clear validation',
            control_number: 'Control Number',
            control_number_identifier: 'Control Number Identifier',
            copy: 'Copy',
            corporate_name: 'Corporate Name',
            corporate_name_or_jurisdiction_name: 'Corporate name or jurisdiction name as entry element',
            current_publication_frequency: 'Current Publication Frequency',
            dates_associated_with_a_name: 'Dates associated with a name',
            delete: 'Delete',
            edit_fields: 'Edit fields',
            family_name: 'Family name',
            forename: 'Forename',
            fuller_form_of_name: 'Fuller form of name',
            general_note: 'General Note',
            inverted_name: 'Inverted name',
            jurisdiction_name: 'Jurisdiction name',
            leader: 'Leader',
            marc_record: 'MARC Record',
            name_in_direct_order: 'Name in direct order',
            personal_name: 'Personal Name',
            predefined_types: 'Predefined types',
            relator_term: 'Relator term',
            serial: 'Serial',
            surname: 'Surname',
            type_of_corporate_name: 'Type of corporate name entry element',
            type_of_personal_name: 'Type of personal name entry element',
            validate: 'Validate',
            warning: 'Warning'
        },
        cutter: [],
        record: {
            ano: "2024",
            cidade: "Cidade",
            folhas: 100,
            nome: "Nome",
            sobrenome: "Sobrenome",
            titulo: "Título de exemplo"
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
                this.cutter.codigo + '      ' +
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
            translate(language) {
                switch (language) {
                    case "pt_BR":
                        this.translation = this.translation_pt_BR;
                        break;
                    case "en_US":
                        this.translation = this.translation_en_US;
                        break;
                    default:
                        this.translation = this.translation_en_US;
                }
            },

            validate() {
                this.errors = null;
                if (this.record.title == "") {
                    this.validation._245a = "is-invalid";
                    if (this.errors == null) {
                        this.errors = [];
                    }
                    this.errors.push({
                        message: 'Title is mandatory'
                    });
                } else {
                    this.validation._245a = "is-valid";
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
                                aria-describedby="titulo">
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