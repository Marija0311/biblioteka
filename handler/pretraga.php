<?php
    require '../konekcija.php';
    require '../model/writer.php';
    require '../model/book.php';

    if(isset($_GET['writerid']))
    {
        $id = mysqli_real_escape_string($conn,$_GET['writerid']);
        $niz = [];
        $rez = $conn->query("select * from book where writerid=$id");
      
        while($red=$rez->fetch_assoc()):
        $books = new Book($red['bookid'],$red['title'],$red['god'],$red['published_in'],$red['writerid']);
        array_push($niz,$books);
        endwhile;

    ?>   
    <table class="table table-hover"  >
    <thead style="font-weight:500px ;background-color:#A2484F; color:white">
        <tr >
            <th scope="col">Title</th>
            <th scope="col">Year</th>
            <th scope="col">Published in</th>
        </tr>
    </thead>
    <tbody style="background-color:#CB918D ;color:#A2484F" >
        <?php echo "<br>"?>
        <?php echo "<br>"?>
        <?php echo "<br>"?>
        <?php echo "<br>"?>
        <?php
        foreach($niz as $vrednost):
            ?>
                <tr>
                <td> <?php echo $vrednost->title  ?></td>
              <td><?php echo $vrednost->god ?>  </td>
              <td><?php echo $vrednost->published_in ?>  </td>
                </tr>
            <?php
        endforeach;
        ?>
    </tbody>
    </table>
    <?php
    }else{
    echo("Molimo vas da prosledite autora.");
    }
 ?>