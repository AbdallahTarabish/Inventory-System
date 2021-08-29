<template>
    <div>
        <div class="modal fade" id="kt_modal_4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">

                        <h5  v-show="!editMode" class="modal-title" >اضافة رف جديد</h5>
                        <h5  v-show="editMode" class="modal-title" >تحديث بيانات الرف </h5>

                        <button type="button" @click="reset_modal()" class="close" data-dismiss="modal"
                                aria-label="Close">
                        </button>
                    </div>
                    <form id="shelf_form" method="post"
                          @submit.prevent="!editMode ?save() : update(shelf_form.id)">
                        <input type="hidden" name="id" :value="shelf_form.id">
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="form-control-label">الاسم:</label>
                                <input v-model="shelf_form.name" type="text"
                                       :class="['form-control ',errors.name?'is-invalid':'' ]"
                                       name="name">
                                <span v-if="errors.name" class="text-danger">{{ errors.name[0] }}</span>
                            </div>

                            <div class="form-group">
                                <label class="form-control-label">القطاع الرئيسي :</label>
                                <select class="form-control" name="sector_id" @change="onChange($event)"
                                        v-model="shelf_form.sector">
                                    <option value="">اختار القطاع الرئيسي</option>
                                    <option v-for="sector in sectors" :value="sector.id"
                                            :selected="shelf_form.sector==sector.id"
                                    >
                                        {{ sector.name }}
                                    </option>
                                </select>

                                <span v-if="errors.sector_id" class="text-danger">{{ errors.sector_id[0] }}</span>
                            </div>

                            <div class="form-group">
                                <label class="form-control-label">القطاع الفرعي :</label>
                                <select class="form-control" name="sub_sector_id">
                                    <option v-for="sub_sector in sub_sectors" :value="sub_sector.id"
                                            :selected="sub_sector.id==shelf_form.sub_sector.id"
                                    >
                                        {{sub_sector.name }}
                                    </option>


                                </select>
                                <span v-if="errors.sub_sector_id"
                                      class="text-danger">{{ errors.sub_sector_id[0] }}</span>
                            </div>
                            <div class="form-group">
                                <label>  الحالة:</label>
                                <select class="form-control" name="isFilled" >
                                    <option value="-1" :selected="shelf_form.isFilled == -1" >غير ممتلئ</option>
                                    <option value="1" :selected="shelf_form.isFilled == 1"  >ممتلئ</option>
                                </select>
                                <span v-if="errors.isFilled" class="text-danger">{{ errors.isFilled[0] }}</span>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                            <button v-show="!editMode" type="submit" class="btn btn-primary">حفظ</button>
                            <button v-show="editMode" type="submit" class="btn btn-primary">تحديث</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="kt-container kt-container--fluid kt-grid__item kt-grid__item--fluid">
            <!--begin::Portlet-->
            <div class="kt-portlet kt-portlet--mobile h-100">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                              <span class="kt-portlet__head-icon">
                                 <i class="kt-font-brand flaticon2-line-chart"></i>
                              </span>
                        <h3 class="kt-portlet__head-title">
                            الرفوف
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <div class="kt-portlet__head-wrapper">
                            <div class="kt-portlet__head-actions">
                                <div class="dropdown dropdown-inline">
                                    <button type="button" class="btn btn-default btn-icon-sm dropdown-toggle"
                                            data-toggle="dropdown-menu" aria-haspopup="true" aria-expanded="false">
                                        <i class="la la-download"></i> Export
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <ul class="kt-nav">
                                            <li class="kt-nav__section kt-nav__section--first">
                                                <span class="kt-nav__section-text">Choose an option</span>
                                            </li>
                                            <li class="kt-nav__item">
                                                <a href="#" class="kt-nav__link">
                                                    <i class="kt-nav__link-icon la la-print"></i>
                                                    <span class="kt-nav__link-text">Print</span>
                                                </a>
                                            </li>
                                            <li class="kt-nav__item">
                                                <a href="#" class="kt-nav__link">
                                                    <i class="kt-nav__link-icon la la-copy"></i>
                                                    <span class="kt-nav__link-text">Copy</span>
                                                </a>
                                            </li>
                                            <li class="kt-nav__item">
                                                <a href="#" class="kt-nav__link">
                                                    <i class="kt-nav__link-icon la la-file-excel-o"></i>
                                                    <span class="kt-nav__link-text">Excel</span>
                                                </a>
                                            </li>
                                            <li class="kt-nav__item">
                                                <a href="#" class="kt-nav__link">
                                                    <i class="kt-nav__link-icon la la-file-text-o"></i>
                                                    <span class="kt-nav__link-text">CSV</span>
                                                </a>
                                            </li>
                                            <li class="kt-nav__item">
                                                <a href="#" class="kt-nav__link">
                                                    <i class="kt-nav__link-icon la la-file-pdf-o"></i>
                                                    <span class="kt-nav__link-text">PDF</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <button  v-show="CheckPremission('sort_stores_create')"  type="button" class="btn btn-brand btn-elevate btn-icon-sm"
                                        data-toggle="modal" @click="reset_modal()" data-target="#kt_modal_4"><i
                                    class="fa fa-plus-circle"></i>اضافة
                                    رف جديد
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="kt-padding-25" style="background-color: #F8F8F8">
                    <form id="search_form">
                        <div class="form-group row align-items-end">
                            <div class="col-md-4">
                                <label>الاسم</label>
                                <div class="input-group ">
                                    <input type="text" name="name" v-model="search_name"
                                           class="form-control " placeholder="ادخل الاسم"/>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label> القطاع الرئيسي</label>
                                <select class="form-control" name="search_sector_id" @change="onChange($event)"
                                        v-model="search_sector">
                                    <option value="" selected>الكل</option>
                                    <option v-for="sector in sectors" :value="sector.id">
                                        {{ sector.name }}
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label> القطاع الفرعي</label>
                                <select class="form-control" name="search_sector_id" v-model="search_sub_sector">
                                    <option value="" selected>الكل</option>
                                    <option v-for="sub_sector in sub_sectors" :value="sub_sector.id">
                                        {{sub_sector.name}}

                                    </option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label>الحالة</label>
                                <div class="input-group ">
                                    <select class="form-control" name="isFilled" v-model="search_isFilled" >
                                        <option value="" selected>الكل</option>

                                        <option value="-1" >غير ممتلئ</option>
                                        <option value="1" >ممتلئ</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <button @click.prevent="load" type="button" href=""
                                        class="btn btn-info btn-elevate btn-icon-sm">
                                    <i class="fa fa-search"></i>
                                    بحث
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="kt-portlet__body">
                    <h3 class="mb-4"></h3>
                    <div class="table-responsive">
                        <table class="table table-bordered products-table">
                            <thead>
                            <tr class="text-center">
                                <th class="font-weight-bold ">اسم الرف</th>

                                <th class="font-weight-bold "> القطاع الفرعي</th>
                                <th class="font-weight-bold ">الحالة</th>




                                <th class="font-weight-bold ">الاجراءات</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="text-center" v-for="shelf in shelfs.data">
                                <td>{{ shelf.name.padStart(3,"0") }}</td>
                                <td v-if="shelf.sub_sector !=null">{{ shelf.sector.name }} - {{ shelf.sub_sector.name.padStart(3,"0") }}</td>
                                <td style="font-weight: bold"  v-else>لايوجد</td>
                                <td v-if="shelf.isFilled == -1" style="color: green; font-weight: bold">غير ممتلئ</td>
                                <td v-if="shelf.isFilled == 1" style="color: red;font-weight: bold">ممتلئ</td>




                                <td>
                                    <button v-show="CheckPremission('sort_stores_update')"  class="btn btn-primary btn-sm" @click="edit(shelf)"><i
                                        class="fa fa-edit"></i></button>
                                    <button v-show="CheckPremission('sort_stores_delete')"  class="btn btn-danger btn-sm" @click="remove(shelf.id)"><i
                                        class="fa fa-trash-alt"></i></button>

                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end mt-3">
                        <pagination  :limit="3" :data="shelfs" @pagination-change-page="load">
                            <span slot="prev-nav">&lt; </span>
                            <span slot="next-nav">التالي ></span>
                        </pagination>
                    </div>
                </div>
            </div>
            <!--end::Portlet-->
        </div>
        <!--begin::Modal-->
    </div>
    <!--end::Modal-->
</template>

<script>
export default {
    created() {
        this.load();
    },
    data() {
        return {
            shelfs: {},
            sectors: [],
            all_sub_sectors: [],
            sub_sectors: [],
            errors: [],
            editMode: false,
            ChooseMode: false,

            shelf_form: {
                id: '',
                name: '',
                sector: '',
                sub_sector: ''

            },
            search_name: '',
            search_sector: '',
            search_sub_sector: '',
            search_isFilled:''



        }
    },
    methods: {
        load(page = 1) {
            axios.get('get_shelfs?page=' + page, {
                params: {
                    name: this.search_name,
                    sector_id: this.search_sector,
                    sub_sector_id: this.search_sub_sector,
                    isFilled:this.search_isFilled


                }
            })
                .then(response => {
                    this.shelfs = response.data;
                });
            axios.get('get_sectors_shelves', {})
                .then(response => {
                    this.sectors = response.data;
                });
            axios.get('get_all_sub_sectors', {})
                .then(response => {
                    this.all_sub_sectors = response.data;
                });


        },
        onChange(event) {
            //  console.log(event.target.value)
            this.shelf_form.sub_sector = ''
            this.ChooseMode = false
            axios.get('get_sub_sector_in_special_Sector', {

                params: {
                    sector_id: event.target.value,
                }
            })
                .then(response => {
                    this.sub_sectors = response.data;
                });
        },
        save() {
            this.errors = [];
            let formData = new FormData(document.getElementById("shelf_form"));
            axios.post('/shelfs', formData
                , {})
                .then(response => {
                    $('#kt_modal_4').modal('hide');
                    $(".modal-backdrop").remove();
                    //  this.reset_modal()

                    Swal.fire({
                        type: 'success',
                        title: "تم الاضافة بنجاح",
                    });
                    this.load();
                    this.errors = [];
                    this.shelf_form.name='';
                    this.sub_sectors=[];

                })
                .catch(error => {
                    this.errors = error.response.data.errors;
                });
        },

        remove(id) {
            swal.fire({
                text: "هل أنت متأكد من عملية الحذف ؟",
                type: "warning",
                buttonsStyling: false,
                confirmButtonText: "<i class='la la-thumbs-up'></i> تأكيد",
                confirmButtonClass: "btn btn-danger",
                showCancelButton: true,
                cancelButtonText: "<i class='la la-thumbs-down'></i> الغاء",
                cancelButtonClass: "btn btn-default"
            }).then((result) => {
                if (result.value) {
                    axios.delete('/shelfs/' + id)
                        .then((response) => {
                            this.load();
                            swal.fire("تم الحذف", "تم الحذف بنجاح", "success");
                        }).catch(() => {
                        swal("Deleted_failed", "error", "error");
                    })
                }
            })
        },
        edit(shelf) {
            this.errors = [];
            $('#kt_modal_4').modal('show');
            this.shelf_form.name = shelf.name;
            this.shelf_form.id = shelf.id;
            this.shelf_form.sector = shelf.sector.id;
            this.shelf_form.sub_sector = shelf.sub_sector;
            this.shelf_form.isFilled = shelf.isFilled;

            axios.get('get_sub_sector_in_special_Sector', {

                params: {
                    sector_id: this.shelf_form.sector,
                }
            })
                .then(response => {
                    this.sub_sectors = response.data;
                });

            this.editMode = true;
            this.ChooseMode = true;

        },
        update(id) {
            this.errors = [];
            let formData = new FormData(document.getElementById("shelf_form"));
            axios.post('/shelfs/' + id,
                formData
            )
                .then((response) => {
                    $('#kt_modal_4').modal('hide');
                    this.load();
                    this.errors = [];
                    Swal.fire({
                        type: 'success',
                        title: "تم التحديث بنجاح",
                    });
                    this.shelf_form.sub_sector = '';
                    this.shelf_form.name='';
                    this.sub_sectors=[];


                }).catch((error) => {
                this.errors = error.response.data.errors;
            })

        },

        reset_modal() {
            this.editMode = false;
            this.shelf_form = {
                id: '',
                name: '',
                sub_sector: '',
                sector: ""
            }
            this.errors = [];

        },
        CheckPremission(Permissions) {
            if (window.App.permissions.includes(Permissions) ) {
                return true;
            }
        },
    },
}
</script>
