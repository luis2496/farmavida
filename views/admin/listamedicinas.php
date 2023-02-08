<?php
$user = $this->d['user'];
//$medicinas = $this->d['medicinas'];
$sucursals = $this->d['sucursals'];

?>

    <?php require_once 'panel.php'; ?>

    <div id="main-container">
    <?php $this->showMessages();?>
        <div id="history-container" class="container">
    
            <div id="history-options">
                <h2>Lista de Medicinas</h2>
                <div id="filters-container">
                    

                    <div class="filter-container">
                        <select id="scategory" class="custom-select">
                            <option value="">Ver Sucursales</option>
                            <?php
                                $options = $sucursals;
                                foreach($sucursals as $option){
                                    echo "<option value=$option >".$option."</option>";
                                }
                            ?>
                        </select>
                    </div>
                </div>   
            </div>
            
            <div id="table-container">
                <table width="100%" cellpadding="0">
                    <thead>
                        <tr>
                        <th data-sort="codMedicina" width="35%">Codigo de la medicina</th>
                       
                        <th data-sort="nombre">Nombre</th>
                        <th data-sort="cantidad">Cantidad</th>
                      
                        <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="databody">
                        
                    </tbody>
                </table>
            </div>
            
        </div>

    </div>

    <script>
        var data = [];
        var copydata = [];
 
        const scategory = document.querySelector('#scategory');
        const sorts = document.querySelectorAll('th');

       

        scategory.addEventListener('change', e =>{
            const value = e.target.value;
            if(value === '' || value === null){
                this.copydata = [...this.data];
                checkForFilters(scategory);
                //renderData(this.copydata);
                return;
            }
            filterByCategory(value);
        });

        function checkForFilters(object){
            if(object.value != ''){
                //console.log('hay un filtro de ' + object.id);
                switch(object.id){
                    

                    case 'scategory':
                        filterByCategory(object.value);
                    break;
                    default:
                }
            }else{
                this.datacopy = [...this.data]; 
                renderData(this.datacopy);
            }
        }

        sorts.forEach(item =>{
            item.addEventListener('click', e =>{
                if(item.dataset.sort){  
                        sortBy(item.dataset.sort);        
                }
            });
        });

        function sortBy(name){
            this.copydata = [...this.data];
            let res;
            switch(name){
                case 'codMedicina':
                    res = this.copydata.sort(compareTitle);
                break;
                    
                case 'nombre':
                    res = this.copydata.sort(compareCategory);
                    break;

                case 'cantidad':
                    res = this.copydata.sort(compareDate);
                    break;
                        
                

                    default:
                    res = this.copydata;
            }

            renderData(res);
        }

       
        

        function filterByCategory(value){
            this.copydata = [...this.data];
            const res = this.copydata.filter(item =>{
                return value == item.codSucursal;
            });
            this.copydata = [...res];
            renderData(res);
        }

        async function getData(){
            data = await fetch('http://localhost/farmavida/listamedicina/getHistoryJSON')
            .then(res =>res.json())
            .then(json => json);
            this.copydata = [...this.data];
            console.table(data);
            renderData(data);
        }
        getData();

        function numberWithCommas(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }

        function renderData(data){
            var databody = document.querySelector('#databody');
            let total = 0;
            databody.innerHTML = '';
            data.forEach(item => { 
                //total += item.amount;
                databody.innerHTML += `<tr>
                        <td>${item.codMedicina}</td>
                        
                        <td>${item.nombre}</td>
                        <td>$${item.cantidad}</td>
                        <td><a href="http://localhost:8080/expense-app/expenses/delete/${item.id}">Eliminar</a></td>
                    </tr>`;
            });
        }
        

        
    </script>