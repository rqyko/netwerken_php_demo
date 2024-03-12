<?php
require_once('../../Backend/src/cijfers.php');

$cijfers = new Cijfers();

$allCijfers = $cijfers->getAllCijfers();

$vak = "";
$periode = "";
$cijfer = "";
$update = false;
$id = 0;

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $vak = $_POST['vak'];
    $periode = $_POST['periode'];
    $cijfer = $_POST['cijfer'];

    $cijfers->updateInfo($id, $vak, $periode, $cijfer);

    header('location: index.php');
}

if (isset($_GET['update'])) {
    $id = $_GET['update'];
    $update = true;

    $result = $cijfers->getVakById($id);

    if ($result) {
        $vak = $result['vak'];
        $periode = $result['periode'];
        $cijfer = $result['cijfer'];
    }
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $cijfers->deleteCijfer($id);

    header('location: index.php');
}

if (isset($_POST['add'])) {
    $vak = $_POST['vak'];
    $periode = $_POST['periode'];
    $cijfer = $_POST['cijfer'];

    $cijfers->addCijfer($vak, $periode, $cijfer);

    header('location: index.php');
}
?>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Vak</th>
            <th>Periode</th>
            <th>Cijfer</th>
        </tr>
    </thead>

    <?php foreach ($allCijfers as $row) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['vak']; ?></td>
            <td><?php echo $row['periode']; ?></td>
            <td><?php echo $row['cijfer']; ?></td>

            <td>
                <a href="index.php?update=<?php echo $row['id']; ?>">Bewerken</a>
            </td>
            <td>
                <a href="index.php?delete=<?php echo $row['id']; ?>">Verwijderen</a>
            </td>
        </tr>
    <?php } ?>
</table>

<form method="post" action="index.php">
    <br><br>
    <h3>Cijfer toevoegen of bewerken</h3>
    <?php if ($update) { ?>
        <input type="hidden" name="id" value="<?php echo $id ?>">
    <?php } ?>
    <p>Vak:</p>
    <input type="text" value="<?php echo $vak ?>" name="vak">
    <p>Periode:</p>
    <input type="text" value="<?php echo $periode ?>" name="periode">
    <p>Cijfer:</p>
    <input type="text" value="<?php echo $cijfer ?>" name="cijfer">
    <br><br>

    <?php if ($update) { ?>
        <input type="submit" name="update" value="Opslaan"></input>
    <?php } else { ?>
        <input type="submit" name="add" value="Toevoegen"></input>
    <?php } ?>
</form>