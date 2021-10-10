<?php
/**
 * Class.inpEndPoint.processRequest File Doc Comment
 * php version 7.4.10
 * 
 * @category ProcessRequest
 * @package  MyPackage
 * @author   Velyana Petrova <velyana.vp@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://localhost/
 */
class ProcessRequest
{
    public static function process($data)
    {
        if (!empty($data)) {
            ?>
        <style>
            <?php include 'css/style.css'; ?>
        </style>
        <div style="overflow-x:auto;">
            <table border="1" id="users" class="center">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>UserName</th>
                        <th>Email</th>
                    </tr>
                </thead>    
                <tbody>
                        <?php
                        foreach ($data as $obj) {
                            ?>
                    <tr>
                        <td><?php echo '<a href="#" onclick="return theApiRequest(' 
                            . $obj->id  .');">' . $obj->id ?> </a> </td> 
                        <td><?php echo '<a href="#" onclick="return theApiRequest(' 
                            . $obj->id  .');">' . $obj->name ?> </a> </td> 
                        <td><?php echo '<a href="#" onclick="return theApiRequest(' 
                            . $obj->id  .');">' . $obj->username ?> </a> </td> 
                        <td><?php echo '<a href="#" onclick="return theApiRequest(' 
                            . $obj->id  .');">' . $obj->email ?> </a> </td> 
                    </tr>
                                <?php     
                        }
                        ?>
                </tbody>
            </table>
        </div>  
    <br>
    <div style="overflow-x:auto; white-space:nowrap;">
        <table id="details">
            <thead>
                <tr>
                    <th>id</th>
                    <th>name</th>
                    <th>username</th>
                    <th>email</th>
                    <th>address.street</th>
                    <th>address.suite</th>
                    <th>address.city</th>
                    <th>address.zipcode</th>
                    <th>address.geo.lat</th>
                    <th>address.geo.lng</th>
                    <th>phone</th>
                    <th>website</th>
                    <th>company.name</th>
                </tr>
            </thead>
            <tbody id="content">
                <tr>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                </tr>
            </tbody>
        </table>
    </div>
        <script>
            document.getElementById("details").style.display = "none";
            var content = document.getElementById('content');

            function theApiRequest (param) {
                var url = 'https://jsonplaceholder.typicode.com/users/'+param;
                fetch(url, {cache: "force-cache"},{
                    method: 'GET', 
                    headers:{
                        'Content-Type': 'application/json'
                    }
                })
                .then(res => res.json())
                .then( data => {
                        table(data)
                    }
                )
            }


            function table(data){                       
                var dataJson = JSON.stringify(data);
                var x = document.getElementById("details");
                if (x.style.display === "none") {
                    x.style.display = "block";
                } else {
                    x.style.display = "block";
                }

                for(let val of dataJson){
                    content.innerHTML = '';
                    content.innerHTML = `
                    <tr>
                        <td>${data.id}</td>
                        <td>${data.name}</td>
                        <td>${data.username}</td>
                        <td>${data.email}</td>
                        <td>${data.address.street}</td>
                        <td>${data.address.suite}</td>
                        <td>${data.address.city}</td>
                        <td>${data.address.zipcode}</td>
                        <td>${data.address.geo.lat}</td>
                        <td>${data.address.geo.lng}</td>
                        <td>${data.phone}</td>
                        <td>${data.website}</td>
                        <td>${data.company.name}</td>
                    </tr>
                `
                }
            }
        </script>

                <?php       
        }

    }

}