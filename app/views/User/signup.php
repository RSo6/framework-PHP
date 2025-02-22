<?php
use wfm\App;
$lang = App::$app->getProperty('language')
?>
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-light p-2">
            <li class="breadcrumb-item"><a href="./"><i class="fas fa-home"></i></a></li>
            <li class="breadcrumb-item active"><?php __('tpl_signup'); ?></li>
        </ol>
    </nav>
</div>

<div class="container py-3">
    <div class="row">

        <div class="col-lg-12 category-content">
            <h1 class="section-title"><?php __('tpl_signup'); ?></h1>

            <form class="row g-3" method="post">

                <div class="col-md-6 offset-md-3">
                    <div class="form-floating mb-3">
                        <input type="email" name="email" class="form-control" id="email" placeholder="name@example.com"
                               value="<?php echo getFieldValue('email')?>">
                        <label class="required" for="email"><?php __('tpl_signup_email_input'); ?></label>
                    </div>
                </div>

                <div class="col-md-6 offset-md-3">
                    <div class="form-floating mb-3">
                        <input type="password" name="password" class="form-control" id="password" placeholder="password">
                        <label class="required" for="password"><?php __('tpl_signup_password_input'); ?></label>
                    </div>
                </div>

                <div class="col-md-6 offset-md-3">
                    <div class="form-floating mb-3">
                        <input type="text" name="name" class="form-control" id="name" placeholder="Name"
                        value="<?php echo getFieldValue('name') ?>">
                        <label class="required" for="name"><?php __('tpl_signup_name_input'); ?></label>
                    </div>
                </div>
                <div class="col-md-6 offset-md-3">
                    <div class="form-floating mb-3">
                        <input type="text" name="phone" class="form-control" id="phone"
                               placeholder="<?php $lang = $lang['id'] == '0' ? '+38' : '+44'?>"
                              value="">
                        <label class="required" for="phone"><?php __('tpl_signup_phone_input'); ?></label>
                    </div>
                </div>

                <div class="col-md-6 offset-md-3">
                    <div class="form-floating mb-3">
                        <input type="text" name="address" class="form-control" id="address" placeholder="Address"
                        value="<?php echo getFieldValue('address')?>">
                        <label class="required" for="address"><?php __('tpl_signup_address_input'); ?></label>
                    </div>
                </div>

                <div class="col-md-6 offset-md-3">
                    <button type="submit" class="btn btn-danger"><?php __('tpl_signup_signup_btn'); ?></button>
                </div>
            </form>

            <?php if (isset($_SESSION['form_data'])) {
                unset($_SESSION['form_data']);
            }?>

        </div>
    </div>
</div>

