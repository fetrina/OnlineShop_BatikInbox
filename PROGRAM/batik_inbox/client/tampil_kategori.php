<div class="teksBannerIjo resize_byscreen3">
            Kategori
</div>
<div class="isiContentLeft">
         <table>
    <?php 
            $tampilkat=mysql_query("SELECT * from kategori");
            
             while($result2=mysql_fetch_array($tampilkat))
             {
                $namakat=$result2['nama'];
                echo "
                <tr>
                    <td>
                        <li style=color:#74cd00;><a href=view_produkbykate.php?idkat=$result2[id_kategori] class='linknya resize_byscreen4'>$namakat</a>
                    </td>
                </tr>
                ";                   
                }
              
    ?>
</table>
        </div>