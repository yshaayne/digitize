<?php
$db = \Config\Database::connect();

if($department)
{
    $num=0;
    foreach($department as $row){
        $builder_folder_count = $db->table('folders');
        $builder_folder_count->where('folder_office', $row["isu"]);
        $query_folder_count = $builder_folder_count->get()->getResult();
        $count_folder_count=0;foreach($query_folder_count as $row_folder_count){$count_folder_count++;}
        if($count_folder_count > 0){
            ?>
            <div class="row row_department">
                <div class="col-sm-12">
                    <span style="font-size:12pt;color:#0E2238;"><?=$row["code"];?> </span>
                    <button type="button" class="btn btn-sm btn-link float-end btn-new-folder"  data-value="<?=$row["isu"];?>" >
                        NEW FOLDER
                    </button>
                </div>
                <?php
                $num++;
                $builder_folder = $db->table('folders');
                $builder_folder->where('folder_office', $row["isu"]);
                $query_folder = $builder_folder->get()->getResult();
                foreach($query_folder as $row_folder){
                    $builder_doc = $db->table('documents');
                    $builder_doc->where('doc_folder', $row_folder->folder_id);
                    $query_doc = $builder_doc->get()->getResult();
                    $count_doc=0;foreach($query_doc as $row_doc){$count_doc++;}
                    ?>
                    <div class="col-sm-2 text-center">
                        <a href="#" id="my-link" class="text-dark" title="Click to open" data-id="<?=$row_folder->folder_id;?>" data-name="<?=$row_folder->folder_name;?>"  data-department="<?=$row["isu"];?>">
                            <img src="<?=base_url("assets/img/folder.png");?>" alt="" style="width:100px;height:100px;"><br>
                            <small><?=$row_folder->folder_name.'('.$count_doc.')';?></small>
                        </a>
                    </div>
                    <?php     
                }
                ?>
            </div>
            <?php 
        }
        ?>
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