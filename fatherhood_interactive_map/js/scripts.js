jQuery( document ).ready(function() {
  "use strict";



});

function do_ajax(nid){


  jQuery.ajax({
    async:true,
    type: "POST",
    url: "/video_player/get_body/"+nid,
    data:{ query: nid  },
    cache: false,
    success: function(data){
      jQuery("#irl_video_body").html(data);
    }
  });

}