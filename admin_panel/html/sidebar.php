<?php
$page = basename($_SERVER['SCRIPT_NAME']);
?>
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
  <div class="app-brand demo">
    <a href="index.php" class="app-brand-link">
      <span class="app-brand-logo demo me-1">
        <span style="color: var(--bs-primary)">

        </span>
      </span>
      <span style="padding-left: 2rem;" class="app-brand-text demo menu-text fw-semibold ms-2">Glam Salon</span>
    </a>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
      <i class="mdi menu-toggle-icon d-xl-block align-middle mdi-20px"></i>
    </a>
  </div>
  <div class="menu-inner-shadow"></div>
  <ul class="menu-inner py-1">
    <!-- Dashboards -->
    <li class="menu-item" <?php if ($page === 'index.php') {
                            echo "active";
                          } ?>>
      <a href="index.php" class="menu-link">
        <i class="menu-icon tf-icons mdi mdi-home-outline"></i>
        <div data-i18n="Dashboards">Dashboard</div>
      </a>
    </li>

    <li class="menu-header fw-medium mt-4">
      <span class="menu-header-text">Apps &amp; Pages</span>
    </li>
    <!-- Pages -->
    <li class="menu-item" <?php if ($page === 'account-settings.php') {
                            echo "active";
                          } ?>>
      <a href="account-settings.php" class="menu-link">
        <i class="menu-icon tf-icons mdi mdi-account-outline"></i>
        <div data-i18n="Account Settings">Account</div>
      </a>
    </li>
    <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons mdi mdi-lock-open-outline"></i>
        <div data-i18n="Authentications">Authentications</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item">
          <a href="auth-forgot-password.php" class="menu-link" target="_blank">
            <div data-i18n="Basic">Forgot Password</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="auth-change_password.php" class="menu-link" target="_blank">
            <div data-i18n="Basic">Change Password</div>
          </a>
        </li>
      </ul>
    </li>

    <!-- Forms & Tables -->
    <li class="menu-header fw-medium mt-4"><span class="menu-header-text">Forms &amp; Tables</span></li>

    <li class="menu-item <?php if (
                            $page === 'add_employee.php' || $page === 'employee_list.php' ||
                            $page === 'add_product.php' || $page === 'product_list.php' || $page === 'product_category.php' ||
                            $page === 'add_service.php' || $page === 'service_list.php' || $page === 'service_category.php' ||
                            $page === 'customer_list.php' || $page === 'customer_details.php' || $page === 'add_customer.php' ||
                            $page === 'add_appointment.php' || $page === 'appointment_list.php' || $page === 'feedback_list.php' ||
                            $page === 'add_admin.php' || $page === 'admin_list.php' ||
                            $page === 'order_details.php' || $page === 'order_list.php'
                          ) {
                            echo "open";
                          } ?>" id="forms">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons mdi mdi-cube-outline"></i>
        <div data-i18n="Form Layouts">Forms</div>
      </a>
      <ul class="menu-sub">

        <li class="menu-item <?php if ($page === 'add_admin.php' || $page === 'admin_list.php') {
                                echo "open";
                              } ?>" id="employee">
          <a href="javascript:void(0); open" class="menu-link menu-toggle">
            <div data-i18n="Form Layouts">Admin</div>
          </a>
          <ul class="menu-sub">
            <li class="menu-item <?php if ($page === 'add_admin.php') {
                                    echo "active";
                                  } ?>" id="add-admin">
              <a href="add_admin.php" class="menu-link">
                <i class="menu-icon tf-icons mdi mdi-form-select"></i>
                <div data-i18n="Vertical Form">Add Admin</div>
              </a>
            </li>
            <li class="menu-item <?php if ($page === 'admin_list.php') {
                                    echo "active";
                                  } ?>" id="employee-list">
              <a href="admin_list.php" class="menu-link">
                <i class="menu-icon tf-icons mdi mdi-table"></i>
                <div data-i18n="Horizontal Form">Admin List</div>
              </a>
            </li>
          </ul>
        </li>

        <li class="menu-item <?php if ($page === 'add_employee.php' || $page === 'employee_list.php') {
                                echo "open";
                              } ?>" id="employee">
          <a href="javascript:void(0); open" class="menu-link menu-toggle">
            <div data-i18n="Form Layouts">Employee</div>
          </a>
          <ul class="menu-sub">
            <li class="menu-item <?php if ($page === 'add_employee.php') {
                                    echo "active";
                                  } ?>" id="add-employee">
              <a href="add_employee.php" class="menu-link">
                <i class="menu-icon tf-icons mdi mdi-form-select"></i>
                <div data-i18n="Vertical Form">Add Employee</div>
              </a>
            </li>
            <li class="menu-item <?php if ($page === 'employee_list.php') {
                                    echo "active";
                                  } ?>" id="employee-list">
              <a href="employee_list.php" class="menu-link">
                <i class="menu-icon tf-icons mdi mdi-table"></i>
                <div data-i18n="Horizontal Form">Employee List</div>
              </a>
            </li>
          </ul>
        </li>

        <li class="menu-item <?php if ($page === 'customer_details.php' || $page === 'customer_list.php' || $page === 'add_customer.php') {
                                echo "open";
                              } ?>">
          <a href="javascript:void(0);" class="menu-link menu-toggle">
            <div data-i18n="Form Layouts">Customer</div>
          </a>
          <ul class="menu-sub">
            <li class="menu-item <?php if ($page === 'add_customer.php') {
                                    echo "active";
                                  } ?>">
              <a href="add_customer.php" class="menu-link">
                <i class="menu-icon tf-icons mdi mdi-form-select"></i>
                <div data-i18n="Vertical Form">Add Customer</div>
              </a>
            </li>
            <li class="menu-item <?php if ($page === 'customer_list.php') {
                                    echo "active";
                                  } ?>">
              <a href="customer_list.php" class="menu-link">
                <i class="menu-icon tf-icons mdi mdi-form-select"></i>
                <div data-i18n="Vertical Form">Customer List</div>
              </a>
            </li>
            <li class="menu-item <?php if ($page === 'customer_details.php') {
                                    echo "active";
                                  } ?>">
              <a href="customer_details.php" class="menu-link">
                <i class="menu-icon tf-icons mdi mdi-table"></i>
                <div data-i18n="Horizontal Form">Customer Details</div>
              </a>
            </li>
          </ul>
        </li>

        <li class="menu-item <?php if ($page === 'add_appointment.php' || $page === 'appointment_list.php') {
                                echo "open";
                              } ?>">
          <a href="javascript:void(0);" class="menu-link menu-toggle">
            <div data-i18n="Form Layouts">Appointment</div>
          </a>
          <ul class="menu-sub">
            <li class="menu-item <?php if ($page === 'add_appointment.php') {
                                    echo "active";
                                  } ?>">
              <a href="add_appointment.php" class="menu-link">
                <i class="menu-icon tf-icons mdi mdi-form-select"></i>
                <div data-i18n="Vertical Form">Add Appointment</div>
              </a>
            </li>
            <li class="menu-item <?php if ($page === 'appointment_list.php') {
                                    echo "active";
                                  } ?>">
              <a href="appointment_list.php" class="menu-link">
                <i class="menu-icon tf-icons mdi mdi-table"></i>
                <div data-i18n="Horizontal Form">Appointment List</div>
              </a>
            </li>
          </ul>
        </li>

        <li class="menu-item <?php if ($page === 'order_details.php' || $page === 'order_list.php') {
                                echo "open";
                              } ?>">
          <a href="javascript:void(0);" class="menu-link menu-toggle">
            <div data-i18n="Form Layouts">Order</div>
          </a>
          <ul class="menu-sub">
            <li class="menu-item <?php if ($page === 'order_list.php') {
                                    echo "active";
                                  } ?>">
              <a href="order_list.php" class="menu-link">
                <i class="menu-icon tf-icons mdi mdi-table"></i>
                <div data-i18n="Vertical Form">Order List</div>
              </a>
            </li>
            <li class="menu-item <?php if ($page === 'order_details.php') {
                                    echo "active";
                                  } ?>">
              <a href="order_details.php" class="menu-link">
                <i class="menu-icon tf-icons mdi mdi-form-select"></i>
                <div data-i18n="Horizontal Form">Order Details</div>
              </a>
            </li>
          </ul>
        </li>

        <li class="menu-item <?php if ($page === 'add_product.php' || $page === 'product_list.php' || $page === 'product_category.php') {
                                echo "open";
                              } ?>" id="product">
          <a href="javascript:void(0);" class="menu-link menu-toggle">
            <div data-i18n="Form Layouts">Product</div>
          </a>
          <ul class="menu-sub">
            <li class="menu-item <?php if ($page === 'add_product.php') {
                                    echo "active";
                                  } ?>" id="add-product">
              <a href="add_product.php" class="menu-link">
                <i class="menu-icon tf-icons mdi mdi-form-select"></i>
                <div data-i18n="Vertical Form">Add Product</div>
              </a>
            </li>
            <li class="menu-item <?php if ($page === 'product_list.php') {
                                    echo "active";
                                  } ?>" id="product-list">
              <a href="product_list.php" class="menu-link">
                <i class="menu-icon tf-icons mdi mdi-table"></i>
                <div data-i18n="Horizontal Form">Product List</div>
              </a>
            </li>
            <li class="menu-item <?php if ($page === 'product_category.php') {
                                    echo "active";
                                  } ?>" id="product-category">
              <a href="product_category.php" class="menu-link">
                <i class="menu-icon tf-icons mdi mdi-table"></i>
                <div data-i18n="Horizontal Form">Product Category</div>
              </a>
            </li>
          </ul>
        </li>

        <li class="menu-item <?php if ($page === 'add_service.php' || $page === 'service_list.php' || $page === 'service_category.php') {
                                echo "open";
                              } ?>" id="services">
          <a href="javascript:void(0);" class="menu-link menu-toggle">
            <div data-i18n="Form Layouts">Services</div>
          </a>
          <ul class="menu-sub">
            <li class="menu-item <?php if ($page === 'add_service.php') {
                                    echo "active";
                                  } ?>" id="add-services">
              <a href="add_service.php" class="menu-link">
                <i class="menu-icon tf-icons mdi mdi-form-select"></i>
                <div data-i18n="Vertical Form">Add Service</div>
              </a>
            </li>
            <li class="menu-item <?php if ($page === 'service_list.php') {
                                    echo "active";
                                  } ?>" id="service-list">
              <a href="service_list.php" class="menu-link">
                <i class="menu-icon tf-icons mdi mdi-table"></i>
                <div data-i18n="Horizontal Form">Service list</div>
              </a>
            </li>
            <li class="menu-item <?php if ($page === 'service_category.php') {
                                    echo "active";
                                  } ?>" id="service-category">
              <a href="service_category.php" class="menu-link">
                <i class="menu-icon tf-icons mdi mdi-table"></i>
                <div data-i18n="Horizontal Form">Service Category</div>
              </a>
            </li>
          </ul>
        </li>

        <li class="menu-item <?php if ($page === 'feedback_list.php') {
                                echo "open";
                              } ?>" id="employee">
          <a href="javascript:void(0); open" class="menu-link menu-toggle">
            <div data-i18n="Form Layouts">Feedback</div>
          </a>
          <ul class="menu-sub">
            <li class="menu-item <?php if ($page === 'feedback_list.php') {
                                    echo "active";
                                  } ?>" id="add-employee">
              <a href="feedback_list.php" class="menu-link">
                <i class="menu-icon tf-icons mdi mdi-form-select"></i>
                <div data-i18n="Vertical Form">Feedback List</div>
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </li>

    <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-file-earmark" viewBox="0 0 16 16">
          <path d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5z" />
        </svg>
        <div style="padding-left: 1rem;" data-i18n="Authentications">Reports</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item">
          <a href="report_product.php" class="menu-link" target="_blank">
            <div data-i18n="Basic">Product</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="report_order.php" class="menu-link" target="_blank">
            <div data-i18n="Basic">Order</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="report_appointment.php" class="menu-link" target="_blank">
            <div data-i18n="Basic">Appointment</div>
          </a>
        </li>
      </ul>
    </li>

  </ul>
</aside>