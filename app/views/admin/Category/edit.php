<!-- Default box -->
<div class="card">

    <div class="card-body">

        <form action="" method="post">

            <div class="form-group">
                <label class="required" for="parent_id">Батьківська категорія</label>
                <?php new \app\widgets\menu\Menu([
                    'cache' => 0,
                    'cacheKey' => 'admin_menu_select',
                    'class' => 'form-control',
                    'container' => 'select',
                    'attrs' => [
                        'name' => 'parent_id',
                        'id' => 'parent_id',
                        'required' => 'required',
                    ],
                    'prepend' => '<option value="0">Самостійна категорія</option>',
                    'tpl' => APP . '/widgets/menu/admin_select_tpl.php',
                ]) ?>
            </div>

<div class="card card-info card-outline card-tabs">
<div class="card-header p-0 pt-1 border-bottom-0">
<ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
<?php foreach (\wfm\App::$app->getProperty('languages') as $k => $lang): // проходимось по мовам?>
<?php //debug($lang) ?>
<?php //debug($k) ?>
<li class="nav-item">
<a class="nav-link <?php if ($lang['base']) echo 'active' ?>" data-toggle="pill" href="#<?php echo $k ?>">
 <img src="<?php echo PATH ?>/assets/img/lang/<?php echo $k ?>.png" alt="">
</a>
 </li>
<?php endforeach; ?>
                    </ul>
                </div>

                <div class="card-body">
                    <div class="tab-content">
                        <?php foreach (\wfm\App::$app->getProperty('languages') as $k => $lang): ?>
                            <div class="tab-pane fade <?php if ($lang['base']) echo 'active show' ?>" id="<?php echo $k ?>">

               <div class="form-group">
                    <label class="required" for="title">Назва</label>
              <input type="text" name="category_description[<?php echo $lang['id'] ?>][title]" class="form-control" id="title" placeholder="Наименование категории" value="<?php echo h($category[$lang['id']]['title'])?>" required2>
            </div>

          <div class="form-group">
                                    <label for="description">Опис</label>
           <input type="text" name="category_description[<?php echo $lang['id'] ?>][description]" class="form-control" id="description" placeholder="Мета-описание" value="<?php echo h($category[$lang['id']]['description'])?>">
        </div>
   <div class="form-group">
<label for="keywords">Ключеві слова</label>
<input type="text" name="category_description[<?php echo $lang['id'] ?>][keywords]" class="form-control" id="keywords" placeholder="Ключевые слова" value="<?php echo h($category[$lang['id']]['keywords']) ?>">
</div>
<div class="form-group">
  <label for="content">Опис категорії</label>
        <textarea name="category_description[<?php echo $lang['id'] ?>][content]" class="form-control editor" id="content" rows="3" placeholder="Описание категории"><?php echo h($category[$lang['id']]['content']) ?></textarea>
    </div>
  </div>
  <?php endforeach; ?>
                    </div>
                </div>
                <!-- /.card -->
            </div>

            <button type="submit" class="btn btn-primary">Зберегти</button>

        </form>

    </div>

</div>
<!-- /.card -->
<script>
    // https://question-it.com/questions/3558262/kak-ja-mogu-sozdat-neskolko-redaktorov-s-imenem-klassa
    // https://ckeditor.com/docs/ckfinder/demo/ckfinder3/samples/ckeditor.html
    window.editors = {};
    document.querySelectorAll( '.editor' ).forEach( ( node, index ) => {
        ClassicEditor
            .create( node, {
                ckfinder: {
                    uploadUrl: '<?php echo PATH ?>/adminlte/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json',
                },
                toolbar: [ 'ckfinder', '|', 'heading', '|', 'bold', 'italic', '|', 'undo', 'redo', '|', 'link', 'bulletedList', 'numberedList', 'insertTable', 'blockQuote' ],
                image: {
                    toolbar: [ 'imageTextAlternative', '|', 'imageStyle:alignLeft', 'imageStyle:alignCenter', 'imageStyle:alignRight' ],
                    styles: [
                        'alignLeft',
                        'alignCenter',
                        'alignRight'
                    ]
                }
            } )
            .then( newEditor => {
                window.editors[ index ] = newEditor
            } )
            .catch( error => {
                console.error( error );
            } );
    });

</script>
