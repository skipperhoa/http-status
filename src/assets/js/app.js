$(document).ready(function(){

     $(".btn-check").click(function(e){
        e.preventDefault();
        var url = $('.url-test').val().trim();
        if(url == '' || url == null || url == undefined){
            alert('Bạn hãy nhập Url');
            return false;
        }
        $.ajax({
            url: '/api/http-status.php',
            method: 'POST',
            data: {
                url: url
            },
            beforeSend: function(){
                $('.loading').show();
            },
            success: function(res){
               let data = JSON.parse(res);
               let result ="<table class='box-result-status'>";
                        result += "<thead>";
                             result += "<tr>";
                                 result += "<th>URL</th>";
                                 result += "<th>Status</th>";
                            result += "</tr>";
                         result += "</thead>"
                         result += "<tbody>";
                            
                         
                   
               result += '<tr>';
               

               for (const [key, value] of Object.entries(data)) {
                
                   
                    if(key=="status"){
                        
                        result += `<td><span class="status_${value}">${value}</span></td>`;
                    }else{
                        result += `<td><span>${value}</span></td>`;
                    }
                 
               }
               result += '</tr>';
               result += '</tbody>';
               result += '</table>';
               $('.loading').hide();
               $('.box-result-content').html(result);
               
            }
        })
     })
})