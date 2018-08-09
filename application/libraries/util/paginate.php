<?php
    class Paginate{}
    function getPageGenerator($totalRow, $currentPage, $url){
        $output =  '
            <div class="pagination"></div>
            <script>
                    $(function(){
                        $(".pagination").paginate({
                                count           : '.$totalRow.',
                                start           : '.$currentPage.',
                                display         : 10,
                                border          : true,
                                border_color	: "#fff",
                                text_color  	: "#fff",
                                background_color    : "#115EBA",	
                                border_hover_color	: "#ccc",
                                text_hover_color  	: "#000",
                                background_hover_color	: "#fff", 
                                images		: false,
                                mouse		: "press",
                                onChange            : function(page){
                                    window.location="'.$url.'&page="+page;
                                }
                        });
                    });
            </script>
        ';
        return $output;
    }
?>
