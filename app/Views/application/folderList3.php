<?php
$db = \Config\Database::connect();

?>
<div class="col-sm-12"><span style="font-size:12pt;color:#0E2238;">
    <?php if($department){echo $department["code"];echo $department["isu"];}?> </span>
    <button type="button" class="btn btn-sm btn-link float-end btn-new-folder"  data-value="<?php if($department){echo $department["isu"];}?>" >
        NEW FOLDER
    </button>
</div>
<?php
if($folder)
{
    $num=0;
    foreach($folder as $row){
       
        $num++;
        $builder_doc = $db->table('documents');
        $builder_doc->where('doc_folder', $row["folder_id"]);
        $query_doc = $builder_doc->get()->getResult();
        $count_doc=0;foreach($query_doc as $row_doc){$count_doc++;}
        ?>
        <div class="col-sm-2  text-center">
            <a href="#" id="my-link" class="text-dark" title="Click to open" data-id="<?=$row["folder_id"];?>" data-name="<?=$row["folder_name"];?>"  data-department="<?php if($department){echo $department["isu"];}?>">
                <img src="<?=base_url("assets/img/folder.png");?>" alt="" style="width:100px;height:100px;"><br>
                <span><?=$row["folder_name"].'('.$count_doc.')';?></span>
            </a>
        </div>
        <?php    
    }
}
?>
<form class="form-open-folder" id="form-open-folder" action="document-setup" method="POST" enctype="multipart/form-data"> 
    <input type="hidden" name="folder_id" id="folder_id" value="0">
    <input type="hidden" name="folder_name" id="folder_name" value="unknown">
    <input type="hidden" name="department_id_x" id="department_id_x" value="0">
    <button type="submit" class="btn btn-sm btn-outline-primary folder-save" style="display:none;" ></button>
</form>
<script>
    $(document).ready(function () {
        $(document).on('click','#my-link', function () { 
            var folder_id = $(this).attr("data-id");
            var folder_name = $(this).attr("data-name");
            var department_id = $(this).attr("data-department");
            $("#folder_id").val(folder_id);
            $("#folder_name").val(folder_name);
            $("#department_id_x").val(department_id);
            document.querySelector('.folder-save').click();
        });

        $(document).on('click','.btn-new-folder', function () { 
            var isu = $(this).attr('data-value');
            $("#department_id").val(isu);
            $('#addModalCenter').modal('show');
        });
    });
</script>