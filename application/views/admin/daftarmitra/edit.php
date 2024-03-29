<div class="container">
    <div class="col-md-6">
        <h5>Edit Form Data</h5>

        <form action="" method="POST"> 
        <input type="hidden" name="id" class="form-control" value="<?= $daftarmitra['id'];?>">
            <div class="form-row">
                <div class="form-group col-md-6">
                <label for="inputKode">ID</label>
                <input type="text" class="form-control" id="inputKode" name="kode"  value="<?= $daftarmitra['kode'];?>" readonly>
                </div>
                <div class="form-group col-md-6">
                <label for="inputNama">Nama</label>
                <input type="text" class="form-control" id="inputNama" name="name"  value="<?= $daftarmitra['name'];?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                <label for="inputTgl">Tgl Lahir</label>
                <input type="date" class="form-control" id="inputTgl" name="tgl_lahir"  value="<?= $daftarmitra['tgl_lahir'];?>">
                </div>
                <div class="form-group col-md-4">
                <label for="dosen_pa">Jabatan</label>
                <select name="jabatan" id="jabatan" class="form-control">
                    <?php foreach ($jabatan as $pr) :?>
                        <?php if ($pr['name'] == $daftarmitra['jabatan']) :?>
                    <option value="<?=$pr['name'];?>" selected><?=$pr['name'];?></option>
                        <?php else :?>
                    <option value="<?=$pr['name'];?>"><?=$pr['name'];?></option>
                        <?php endif;?>
                    <?php endforeach;?>
                    </select>
                </div>
                <div class="form-group col-md-4">
                <label for="inputPromoter">Promoter</label>
                <input type="text" class="form-control" id="inputPromoter" name="promoter"  value="<?= $daftarmitra['promoter'];?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                <label for="inputTahun">Tahun Gabung</label>
                <input type="text" class="form-control" id="inputTahun" name="thn_gabung"  value="<?= $daftarmitra['thn_gabung'];?>">
                </div>
                <div class="form-group col-md-6">
                <label for="inputGudang">Gudang</label>
                <select name="gudang" id="gudang" class="form-control">
                    <?php foreach ($gudang as $pr) :?>
                        <?php if ($pr['nama'] == $daftarmitra['gudang']) :?>
                    <option value="<?=$pr['nama'];?>" selected><?=$pr['nama'];?></option>
                        <?php else :?>
                    <option value="<?=$pr['nama'];?>"><?=$pr['nama'];?></option>
                        <?php endif;?>
                    <?php endforeach;?>
                    </select>
                </div>
            </div>
                <div class="form-group">
                <label for="inputAlamat">Alamat</label>
                <input type="text" class="form-control" id="inputAlamat" name="alamat"  value="<?= $daftarmitra['alamat'];?>">
                </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                <label for="inputKota">Kota</label> 
                <input type="text" class="form-control" id="inputKota" name="kota"  value="<?= $daftarmitra['kota'];?>">
                </div>
                <div class="form-group col-md-6">
                <label for="inputTelepon">Telepon</label>
                <input type="text" class="form-control" id="inputTelepon" name="telepon"  value="<?= $daftarmitra['telepon'];?>">
                </div>
            </div>
                <div class="form-group">
                <label for="inputEmail">Email</label>
                <input type="text" class="form-control" id="inputEmail" name="email"  value="<?= $daftarmitra['email'];?>">
                </div>
               

            <button type="submit" class="btn btn-primary mb-2">Edit Data</button>
            <a href="<?= base_url('admin/daftar_mitra');?>" class="btn btn-success mb-2">Kembali</a>
            </form>
    </div>
</div>