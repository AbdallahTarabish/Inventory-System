<?php
if (!function_exists("breadCrumb")) {

    function breadCrumb($array_of_page = [])
    {
        echo '<div class="kt-subheader   kt-grid__item"><div class="kt-container  kt-container--fluid "><div class="kt-subheader__main">
      <h3 class="kt-subheader__title">' . $array_of_page["main_page"] . '</h3>
      <span class="kt-subheader__separator kt-hidden"></span><div class="kt-subheader__breadcrumbs"> <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>';
        foreach ($array_of_page["page"] as $item => $value) {

            echo '<span class="kt-subheader__breadcrumbs-separator"></span>
                <a class="kt-subheader__breadcrumbs-link"   href="' . $value["href"] . '"> ' . $value["page_name"] . '   </a>
            ';
        }
        echo '</div></div></div></div>';
    }
}

if (!function_exists("aside_menu")) {

    function aside_menu($array_of_menu)
    {

        foreach ($array_of_menu as $k => $v) {
            echo '<li class="kt-menu__section ">
                <h4 class="kt-menu__section-text">' . $v["menu_name"] . '</h4>
                <i class="kt-menu__section-icon flaticon-more-v2"></i>
            </li>';
            foreach ($v["sections"] as $item => $section) {
                if (empty($section["operation"])) {
                    echo '
                      <li class="kt-menu__item " aria-haspopup="true">
                      <a href="' . url($section["link"])  . '" class="kt-menu__link "><span class="kt-menu__link-icon">
                 ' . $section["logo"] . '

						</span>
						<span class="kt-menu__link-text">' . $section["section_name"] . '</span>
						</a>
            </li>

                    ';
                } else {
                    echo '<li class="kt-menu__item  kt-menu__item--submenu " aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                        <a href="javascript:;" class="kt-menu__link kt-menu__toggle"><span class="kt-menu__link-icon">
                        ' . $section["logo"] . '
						</span><span class="kt-menu__link-text">' . $section["section_name"] . '</span><i class="kt-menu__ver-arrow la la-angle-right"></i>
						</a>
                <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                    <ul class="kt-menu__subnav">';
                    foreach ($section["operation"] as $kk => $operation) {
                        echo '
                <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true"><span class="kt-menu__link"><span class="kt-menu__link-text">روابط الصفحات</span></span></li>
                <li class="kt-menu__item" aria-haspopup="true"><a href="' . $kk . '" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">' . $operation . '</span></a></li>
                ';
                    }
                    echo '
                    </ul>
                </div>
            </li>';
                }

            }

        }

    }
};





