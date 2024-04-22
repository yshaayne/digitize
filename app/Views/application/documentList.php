
<?php
$db = \Config\Database::connect();
$db_account = \Config\Database::connect('account');
$loggedInEmp_id = session()->get('loggedInEmp_id');
 $folder_name = "x";
 if($folder){
    $folder_name = $folder["folder_name"];
 }
?>
<style>
    .tdcol{margin:0px !important;padding:0px !important;}   
</style>
<table class="table documentTable table-bordered table-hover" id="docTable" style="font-size:9pt;">
    <thead class="thead-dark">
        <tr>
            <th scope="col" class="text-center "> <small>#</small> </th>
            <th scope="col" class="text-center"><small>NAME <br>(download)</small></th>
            <th scope="col" class="text-center"><small>DESCRIPTION</small></th>
            <th scope="col" class="text-center"><small>SIZE</small></th>
            <th scope="col" class="text-center"><small>DATE</small></th>
            <th scope="col" class="text-center"><small>USER</small></th>
            <th scope="col" class="text-center"><small>ACTION</small></th>
        </tr>
    </thead>
    <tbody class="document-body">
        <?php
        
        if($document && $folder_name!="x")
        {
            $num=0;
            foreach($document as $row){
                $num++;
                $user="unknown";
                if($row['doc_user']!=$loggedInEmp_id){
                    $builder_user = $db_account->table('tbl-employee');
                    $builder_user->where('emp_id', $row['doc_user']);
                    $query_user = $builder_user->get()->getResult();
                    foreach($query_user as $row_user){
                        $user=$row_user->fname.' '.$row_user->sname;
                    }
                }
                else{
                    $user="me"; 
                }
                $type_file="file.png";
                if($row["doc_type"]=="pdf"){
                    $type_file="pdf.png";
                }
                else if($row["doc_type"]=="doc" || $row["doc_type"]=="docx" || $row["doc_type"]=="docm" || $row["doc_type"]=="dot"){
                    $type_file="word.png";
                }
                else if($row["doc_type"]=="xls" || $row["doc_type"]=="xlsm" || $row["doc_type"]=="xlsx" || $row["doc_type"]=="xlt"){
                    $type_file="excel.png";
                }
                else if($row["doc_type"]=="pptx" || $row["doc_type"]=="ppsx" || $row["doc_type"]=="odp "){
                    $type_file="point.png";
                }
                else{}
                ?>
                <tr>
                    <td class="text-center " style="padding: 0px !important;margin: 0px !important;">
                        <small><?=$num;?></small>
                        <input type="hidden" class="doc_id" value="<?=$row["doc_id"];?>">
                    </td>
                    <td class="tdcol" style="margin:0px !important;padding:0px !important;">
                    &nbsp;
                    <a href="<?=base_url('folder_root/'.$folder_name.'/').''.$row["doc_path"];?>"  download="<?=$row["doc_name"];?>" title="Click to download">
                        <img src="<?=base_url('/assets/img/').''.$type_file;?>" alt="" style="width:20px;height:20px;">
                        <small style="font-size:10pt;">
                            <?=$row["doc_name"];?>
                        </small>
                    </a>
                    </td>
                    <td style="margin:0px !important;padding:0px !important;"><small><?=$row["doc_desc"];?></small></td>
                    <td class="tdcol text-center" style="margin:0px !important;padding:0px !important;"><small><?=$row["doc_size"]/1000;?> kb</small></td>
                    <td class="tdcol text-center" style="margin:0px !important;padding:0px !important;"><small><?=$row["doc_date"];?></small></td>
                    <td class="tdcol text-center" style="margin:0px !important;padding:0px !important;"><small><?=$user;?></small></td>
                    <td class="tdcol text-center" style="margin:0px !important;padding:0px !important;">
                        <a href="#" class="btn btn-sm btn-outline-primary   edit_btn" title="EDIT">EDIT</a> 
                        <a href="#" class="btn btn-sm btn-outline-danger  delete_btn" title="DELETE">DEL</a>   
                    </td>
                    
                    <!-- <td class="tdcol" style="margin:0px !important;padding:0px !important;"><?//=$row["doc_desc"];?></td> -->
                    
                </tr>
                <?php    
            }
        }
        ?>
    </tbody>
</table>

<script>
    $(document).ready(function () {
        //$('#docTable').DataTable();
        
        $('#docTable').dataTable( {
            "order": [],
            // Your other options here...
        } );
    });
</script>