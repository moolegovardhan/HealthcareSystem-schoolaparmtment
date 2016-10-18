
    erpapp.service('loaderApply',[function(){
      this.applyLoader = function (status,loaderDom) {
         
        if(status) {
          if(loaderDom) {
            $(loaderDom).append('<div class="ajax-overlay pos-abs"><div class="loader"></div></div>');
          }else {
            $('body').append('<div class="ajax-overlay pos-fixed"><div class="loader"></div></div>');
          }
        }else {
          if(loaderDom) {
            $(loaderDom).find('.ajax-overlay').remove();
          }else {
           $('.ajax-overlay').remove();
          }
        }
      };
      
    }]);