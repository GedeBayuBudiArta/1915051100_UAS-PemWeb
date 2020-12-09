<?php

require_once("../functions.php");
$mahasiswa = cari($_POST["keyword"]);

?>


<table class="table row-hover">
    <thead>
        <tr>
            <th>No</th>
            <th>Aksi</th>
            <th>Gambar</th>
            <th>Nim</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Jurusan</th>
        </tr>
    </thead>
    <tbody>

        <?php $i = 1; ?>
        <?php foreach ( $mahasiswa as $row) : ?>
        <tr class="row-hover">
            <td><?php echo $i; ?></td>
            <td>
                <a class="button success drop-shadow" href="ubah.php?id=<?php echo $row["id"]; ?>"><span class="mif-pencil mif-2x"></span> Edit</a>
                <a class="button alert drop-shadow" href="hapus.php?id=<?php echo $row["id"]; ?>" onclick="return confirm('Yakin');"><span class="mif-bin mif-2x"></span>Hapus</a>
            </td>
            <td><img class="drop-shadow" src="img/<?php echo $row["gambar"]; ?>" alt="" width="50"></td>
            <td> <?php echo $row["nim"]; ?></td>
            <td><?php echo $row["nama"]; ?></td>
            <td><?php echo $row["email"]; ?></td>
            <td><?php echo $row["jurusan"]; ?></td>
        </tr>
        <?php $i++; ?>
        <?php endforeach; ?>
    </tbody>
    </table>
    </div>