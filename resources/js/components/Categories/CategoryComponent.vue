<template>
    <div>
        <div class="kt-container kt-container--fluid kt-grid__item kt-grid__item--fluid">

            <!--begin::Portlet-->
            <div class="kt-portlet kt-portlet--mobile h-100">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon2-line-chart"></i>
										</span>
                        <h3 class="kt-portlet__head-title">
                            عرض معلومات الاصناف الفرعية
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <div class="kt-portlet__head-wrapper">
                            <div class="kt-portlet__head-actions">
                                <div class="dropdown dropdown-inline">
                                    <button type="button" class="btn btn-default btn-icon-sm dropdown-toggle"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="la la-download"></i> تصدير
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
                                <a v-show="this.CheckPremission('categories_create')" href="/categories/create" name="add_and_show" type="submit"
                                   class="btn btn-brand btn-elevate btn-icon-sm ">
                                    <i class="fa fa-plus-circle"></i>
                                    اضافة
                                    صنف جديد
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="kt-padding-25" style="background-color: #F8F8F8">
                    <form id="category_form">
                        <div class="form-group row align-items-end">
                            <div class="col-md-3">
                                <label> البحث</label>
                                <input  v-model="search_categories.search_name" type="text"  class="form-control" placeholder="أبحث بواسطة الاسم">
                            </div>
                            <div class="col-md-3">
                                <label> البحث بواسطة الصنف الرئيسي</label>
                                <select   v-model="search_categories.search_main" class="form-control ">
                                    <option value="">الكل</option>
                                    <option v-for="main_category in all_main_categories" :value=main_category.id>
                                        {{ main_category.name }}
                                    </option>

                                </select>
                            </div>
                            <div class="col-md-3">
                                <label> الحالة</label>
                                <select   v-model="search_categories.search_status" class="form-control ">
                                    <option value="">الكل</option>
                                    <option value="1">مفعل</option>
                                    <option value="-1">معطل</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <button  @click.prevent="load" type="button" href="" class="btn btn-info btn-elevate btn-icon-sm">
                                    <i class="fa fa-search"></i>
                                    بحث
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="kt-portlet__body">
                    <div class="table-responsive">
                        <table class="table table-bordered products-table">
                            <thead>
                            <tr class="text-center font-weight-bold">
                                <th class="font-weight-bold ">اسم الصنف</th>
                                <th class="font-weight-bold ">الوصف</th>
                                <th class="font-weight-bold ">الصنف التابع له</th>
                                <th class="font-weight-bold ">انشأ بواسطة</th>
                                <th class="font-weight-bold ">تم التعديل بواسطة</th>

                                <th class="font-weight-bold ">الحالة</th>

                                <th class="font-weight-bold ">الاجراءات</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="text-center" v-for="category in categories.data">

                                <td>{{ category.name }}</td>
                                <td v-if="category.description">{{ category.description }}</td>
                                <td v-else="" style="color: red">غير مدخل</td>
                                <td>{{ category.main.name }}</td>
                                <td>{{ category.created_by }}</td>
                                <td v-if="category.updated_by">{{ category.updated_by }}</td>
                                <td v-else="" >لم يتم التعديل</td>
                                <td v-if="category.status ==1" class="text-success font-weight-bold">
                                    مفعل
                                </td>
                                <td class="text-danger font-weight-bold" v-else>
                                    معطل
                                </td>
                                <td>
                                    <a class="btn btn-primary btn-sm" :href="'/categories/' + category.id+ '/edit'">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <button class="btn btn-danger btn-sm" @click="remove(category.id)">
                                        <i class="fa fa-trash-alt"></i>
                                    </button>
                                    <button v-show="CheckPremission('categories_update')" title="تعطيل" v-if="category.status ==1"
                                            class="btn btn-warning btn-sm"
                                            @click="disable(category.id)"><i
                                        class="fa fa-window-close"></i></button>
                                    <button v-show="CheckPremission('categories_delete')" title="تفعيل" v-else class="btn btn-success btn-sm"
                                            @click="active(category.id)"><i
                                        class="fa fa-check"></i></button>
                                </td>


                            </tr>

                            </tbody>
                        </table>

                    </div>
                    <div class="d-flex justify-content-end mt-3">
                        <pagination  :data="categories" @pagination-change-page="load">
                            <span slot="prev-nav"> السابق</span>
                            <span slot="next-nav">التالي </span>
                        </pagination>
                    </div>

                </div>
            </div>
        </div>
        <!--end::Portlet-->

    </div>
    <!--begin::Modal-->
    <!--end::Modal-->
</template>

<script>
export default {
    created() {
        this.load();
    },
    data() {
        return {
            categories: {},
            all_main_categories: [],
            errors: [],
            editMode: false,
            category_form: {
                id: '',
                name: '',
                description: '',
                main_categoty_id: ''
            },
            search_categories: {
                search_name: '',
                search_status: '',
                search_main: ''
            },
        }
    },

    methods: {
        load(page = 1) {
            axios.get('get-categories?page=' + page, {
                params: {
                    name: this.search_categories.search_name,
                    status: this.search_categories.search_status,
                    search_main: this.search_categories.search_main,

                }
            })
                .then(response => {
                    this.categories = response.data;
                });
            axios.get('/get-all-main-categories')
                .then(response => {
                    this.all_main_categories = response.data;
                });
        },
        save() {
            this.errors = [];
            let formData = new FormData(document.getElementById("main_category_form"));
            axios.post('api/main_categories', formData
                , {})
                .then(response => {
                    $('#kt_modal_4').modal('hide');
                    this.load();
                    this.errors = [];
                })
                .catch(error => {
                    this.errors = error.response.data.errors;
                });
        },
        disable(id) {
            axios.post('/categories/disable/' + id
                , {})
                .then(response => {
                    Swal.fire({
                        type: 'success',
                        title: "تم التعطيل بنجاح",
                    });
                    this.load();
                })
                .catch(error => {
                });
        },
        active(id) {
            axios.post('/categories/active/' + id
                , {})
                .then(response => {
                    Swal.fire({
                        type: 'success',
                        title: "تم التفعيل بنجاح",
                        confirmButtonText: "<i class='la la-thumbs-up'></i> تم",
                    });
                    this.load();
                })
                .catch(error => {
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
                    axios.delete('/categories/' + id)
                        .then((response) => {
                            this.load();
                            swal.fire("تم الحذف", "تم الحذف بنجاح", "success");
                        }).catch(() => {
                        swal("Deleted_failed", "error", "error");
                    })
                }
            })
        },
        edit(category) {
            this.errors = [];
            this.main_category_form.name = main_category.name;
            this.main_category_form.description = main_category.description;
            this.main_category_form.id = main_category.id;
        },
        update(id) {
            this.errors = [];
            var formData = new FormData();
            formData.append('name', this.main_category_form.name);
            formData.append('description', this.main_category_form.description);
            //   alert();
            axios.patch('api/main_categories/' + id,
                formData
            )
                .then((response) => {
                    $('#kt_modal_4').modal('hide');
                    this.load();
                    this.errors = [];
                }).catch((error) => {
                this.errors = error.response.data.errors;
            })
        },
        openModalWindow() {
            this.editMode = false;
            this.user_form.name = '';
            this.user_form.title = '';
            this.user_form.id = '';
        },
        CheckPremission(Permissions) {
            if (window.App.permissions.includes(Permissions) ) {
                return true;
            }
        },
    },
}
</script>
