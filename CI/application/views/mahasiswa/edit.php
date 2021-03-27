<?php echo form_open('mahasiswa/edit/'.$mahasiswa->nim);?>
<?php echo form_hidden('nim',$mahasiswa->nim);?>

<table>
    <tr><td>NIM</td><td><?php echo form_input('',$mahasiswa->nim,"disabled");?></td></tr>
    <tr><td>NAMA</td><td><?php echo form_input('nama',$mahasiswa->nama);?></td></tr>
    <tr><td>JURUSAN</td><td>
            <select name="jurusan">
            <?php
            foreach ($jurusan as $j){
                echo "<option value='$j->id_jurusan' ";
                echo $mahasiswa->id_jurusan==$j->id_jurusan?'selected':'';
                echo ">$j->nama_jurusan</option>";
            }
            ?>
            </select>
        </td></tr>
    <tr><td>ALAMAT</td><td><?php echo form_input('alamat',$mahasiswa->alamat);?></td></tr>
    <tr><td colspan="2">
        <?php echo form_submit('submit','Simpan');?>
        <?php echo anchor('mahasiswa','Kembali');?></td></tr>
</table>
<?php
echo form_close();
?>