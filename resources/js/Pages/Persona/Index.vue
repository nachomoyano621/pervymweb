<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { Head } from "@inertiajs/vue3";
import DataTable from "datatables.net-vue3";
import "datatables.net-dt/css/jquery.dataTables.css";
import ButtonsHtml5 from "datatables.net-buttons/js/buttons.html5";
import "datatables.net-buttons/js/buttons.print";
import "datatables.net-responsive-dt";
import "datatables.net-responsive-dt/css/responsive.dataTables.min.css";
import JsZip from "jszip";
import pdfmake from "pdfmake/build/pdfmake";
import * as pdfFonts from "pdfmake/build/vfs_fonts";
import ShowButton from "@/Components/ShowButton.vue";
import Modal from "@/Components/Modal.vue";
import { useForm } from "@inertiajs/vue3";
import { ref } from "vue";


pdfmake.vfs = pdfFonts.pdfMake ? pdfFonts.pdfMake.vfs : pdfmake.vfs;
window.JSZip = JsZip;
DataTable.use(ButtonsHtml5);

const nameInput = ref(null);
const modal = ref(false);
const title = ref("");
const id = ref("");

const props = defineProps({
    persona: { type: Object },


});


const form = useForm({
    nombre: "",
    documento: "",
    tipo_documento: "",
    fecha_dif: "",
    direccion: "",
    clase:"",
    sexo: "",
    profesion: "",
    dpto: "",
    documentos:[],
    sexos:[],
    departamentos:[],
    fecha_nac: "",


});
const formPage = useForm({});

const buttons = ref([]);

const openModal = (
    per
) => {
    modal.value = true;

    title.value = "Personas";
    form.id = id;
    form.nombre = per.nombre;
    form.documento = per.documento;
    form.tipo_documento = per.tipo_documento;
    form.clase = per.clase;
    form.fecha_dif = per.fecha_dif;
    form.direccion = per.direccion;
    form.dpto = per.dpto;
    form.profesion = per.profesion;
    form.fecha_nac = per.fecha_nac;
    form.sexos.sexo = per.sexos.sexo;
    form.documentos.nombre_tipodoc= per.documentos.nombre_tipodoc;
    form.departamentos.nombre= per.departamentos.nombre;
};

const closeModal = () => {
    modal.value = false;
    form.reset();
};

buttons.value = [
    {
        title: "Personas",
        extend: "excelHtml5",
        text: '<i class="fa-solid fa-file-excel"></i> Excel',
        className:
            "inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150",
    },
    {
        title: "Personas",
        extend: "pdfHtml5",
        text: '<i class="fa-solid fa-file-pdf"></i> PDF',
        className:
            "inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150",
    },
    {
        title: "Personas",
        extend: "print",
        text: '<i class="fa-solid fa-print"></i> IMPRIMIR',
        className:
            "inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150",
    },
    {
        title: "Personas",
        extend: "copy",
        text: '<i class="fa-solid fa-copy"></i> COPIAR',
        className:
            "inline-flex items-center px-4 py-2 bg-gray-200 border border-gray-800 rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150",
    },
];


</script>

<template>
    <Head title="Personas" />

    <AuthenticatedLayout>
        <template #header>
            <h1
                class="font-semibold text-xl text-gray-800 leading-tight text-center"
            >
                Personas
            </h1>
        </template>

        <div class="py-12">
            <div class="bg-white grid v-screen place-items-center">
                <br />
                <DataTable
                    class="w-full border border-gray-400"
                    :options="{
                        responsive: false,
                        autoWidth: false,
                        dom: 'Bfrtip',
                        buttons: buttons,

                    }"
                >
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-2 py-2">NRO.</th>
                            <th class="px-2 py-2">NOMBRE</th>
                            <th class="px-2 py-2">DOCUMENTO</th>
                            <th class="px-2 py-2">TIPO DOCUMENTO</th>
                            <th class="px-2 py-2">FECHA DEFUNCION</th>
                            <th class="px-2 py-2">ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(per, i) in persona" :key="per.id">
                            <td
                                v-if="per.fecha_dif != null"
                                class="border border-gray-400 px-2 py-2 bg-red-400"
                            >
                                {{ i + 1 }}
                            </td>
                            <td
                                v-if="per.fecha_dif != null"
                                class="border border-gray-400 px-2 py-2 bg-red-400"
                            >
                                {{ per.nombre }}
                            </td>
                            <td
                                v-if="per.fecha_dif != null"
                                class="border border-gray-400 px-2 py-2 bg-red-400"
                            >
                                {{ per.documento }}
                            </td>
                            <td
                                v-if="per.fecha_dif != null"
                                class="border border-gray-400 px-2 py-2 bg-red-400"
                            >

                                {{ per.documentos.nombre_tipodoc}}
                            </td>

                            <td
                                v-if="per.fecha_dif != null"
                                class="border border-gray-400 px-2 py-2 bg-red-400"
                            >
                                {{ per.fecha_dif }}

                            </td>

                            <td
                                v-if="per.fecha_dif != null"
                                class="border border-gray-400 px-2 py-2 bg-red-400"
                            >
                                <ShowButton
                                    @click="
                                        openModal(
                                            per
                                        )
                                    "
                                >
                                    <i class="fa-solid fa-eye"></i>
                                </ShowButton>
                            </td>

                            <td
                                v-if="per.fecha_dif == null"
                                class="border border-gray-400 px-2 py-2"
                            >
                                {{ i + 1 }}
                            </td>
                            <td
                                v-if="per.fecha_dif == null"
                                class="border border-gray-400 px-2 py-2"
                            >
                                {{ per.nombre }}
                            </td>
                            <td
                                v-if="per.fecha_dif == null"
                                class="border border-gray-400 px-2 py-2"
                            >
                                {{ per.documento }}
                            </td>
                            <td
                                v-if="per.fecha_dif == null"
                                class="border border-gray-400 px-2 py-2"
                            >
                                {{ per.documentos.nombre_tipodoc }}
                            </td>

                            <td
                                v-if="per.fecha_dif == null"
                                class="border border-gray-400 px-2 py-2"
                            >
                                {{ per.fecha_dif }}
                        </td>

                            <td
                                v-if="per.fecha_dif == null"
                                class="border border-gray-400 px-2 py-2"
                            >
                                <ShowButton
                                    @click="
                                        openModal(
                                            per
                                        )
                                    "
                                >
                                    <i class="fa-solid fa-eye"></i>
                                </ShowButton>
                            </td>
                        </tr>
                    </tbody>
                </DataTable>
            </div>
        </div>

        <Modal :show="modal" @close="closeModal">
            <h1 class="p-3 text-lg font.medium text-hray-900 text-center font-semibold">{{ title }}</h1>

            <div class="flex mb-4">
            <div class="w-1/2 p-3">
                <InputLabel for="nombre" value="Nombre"></InputLabel>
                {{ form.nombre }}
            </div>
            <div class="w-1/2 p-3">
                <InputLabel for="documento" value="Documento"></InputLabel>
                {{ form.documento }}
            </div>
        </div>
        <div class="flex mb-4">
            <div class="w-1/2 p-3">
                <InputLabel for="tipo_documento" value="Tipo Documento">
                </InputLabel>
                {{ form.documentos.nombre_tipodoc}}
            </div>
            <div class="w-1/2 p-3">
                <InputLabel for="clase" value="Clase">
                </InputLabel>
                {{ form.clase }}
            </div>
        </div>
        <div class="flex mb-4">
             <div class="w-1/2 p-3">
                <InputLabel
                    for="fecha_dif"
                    value="Fecha defuncion"
                ></InputLabel>
                {{form.fecha_dif}}
            </div>
            <div class="w-1/2 p-3">
                <InputLabel for="direccion" value="Direccion"></InputLabel>
                {{ form.direccion }}
            </div>
        </div>
        <div class="flex mb-4">
            <div class="w-1/2 p-3">
                <InputLabel for="sexo" value="Sexo"></InputLabel>
                {{ form.sexos.sexo }}
            </div>
            <div class="w-1/2 p-3">
                <InputLabel for="profesion" value="Profesion"></InputLabel>
                {{ form.profesion }}
            </div>
            </div>
            <div class="flex mb-4">
            <div class="w-1/2 p-3">

                <InputLabel for="depto" value="Departamento"> </InputLabel>
                {{ form.departamentos.nombre }}

            </div>
            <div class="w-1/2 p-3">

        <InputLabel for="fecha_nac" value="Fecha Nacimiento"> </InputLabel>
        {{ form.fecha_nac }}

</div>
        </div>
            <div class="p-3 mt-6">
                <PrimaryButton
                    class="ml-3"
                    :disabled="form.processing"
                    @click="closeModal"

                >
                    Cerrar
                </PrimaryButton>
            </div>
        </Modal>
    </AuthenticatedLayout>
</template>
