var erpapp = angular.module("erpApp",["ui.router", 'CtrlModule','TaxCtrlModule','ChargeCtrlModule','WardsCtrlModule',
    'RoomCtrlModule','RoomTypeCtrlModule','HosProviderCtrlModule','ServicesTypeCtrlModule','CreateCostCtrlModule','PatientCtrlModule'
    ,'OperationsCtrlModule']);

erpapp.config(function($stateProvider, $urlRouterProvider){
    $urlRouterProvider.otherwise("/login");
    
    $stateProvider.state("admin", {url:"/admin", abstract: true, templateUrl:"partials/adminpanel.html"})
    .state("admin.dashboard", {url:"/dashboard", templateUrl: "partials/admin.dashboard.html"})
    .state("login", {url:"/login", templateUrl:"partials/login.html", controller: "LoginController"})
    .state("admin.company",{url:"/company", templateUrl:"partials/admin.company.html", controller:"CompanyController"})
    .state("admin.supplier",{url:"/supplier", templateUrl:"partials/admin.supplier.html", controller:"SupplierController"})
    .state("admin.category",{url:"/category", templateUrl:"partials/admin.category.html", controller:"CategoryController"})
    .state("admin.subcategory",{url:"/subcategory", templateUrl:"partials/admin.subcategory.html", controller:"SubCategoryController"})
    .state("admin.medicine",{url:"/medicine", templateUrl:"partials/admin.medicine.html", controller:"MedicineController"})
    .state("admin.customer",{url:"/customer", templateUrl:"partials/admin.customer.html"})
    .state("admin.tax",{url:"/tax", templateUrl:"partials/admin.tax.html", controller:"TaxController"})
    .state("admin.charges",{url:"/charges", templateUrl:"partials/admin.charges.html", controller:"ChargeController"})
     .state("admin.wards",{url:"/wards", templateUrl:"partials/admin.wards.html", controller:"WardController"})
    .state("admin.room",{url:"/room", templateUrl:"partials/admin.room.html", controller:"RoomController"})
     .state("admin.services",{url:"/services", templateUrl:"partials/admin.services.html", controller:"HosProviderController"})
      .state("admin.createcost",{url:"/CreateCost", templateUrl:"partials/admin.createcostforservices.html", controller:"CreateCostController"})
        .state("admin.operations",{url:"/Operations", templateUrl:"partials/admin.operation.html", controller:"OperationController"})
    .state("admin.po",{url:"/po", templateUrl:"partials/admin.po.html", controller:"POController"})
    .state("admin.invoice",{url:"/invoice", templateUrl:"partials/admin.invoice.html", controller: "InvoiceController"})
    .state("admin.inward",{url:"/inward", templateUrl:"partials/admin.inward.html"})
    .state("admin.so",{url:"/so", templateUrl:"partials/admin.so.html", controller: "SOController"})
    .state("admin.pregistration",{url:"/pregistration", templateUrl:"partials/patient/patient.patientregistration.html", controller: "PatientController"})
    .state("admin.bill",{url:"/bill", templateUrl:"partials/admin.bill.html"})
})

erpapp.directive('modal', function () {
    return {
      template: '<div class="modal fade">' + 
          '<div class="modal-dialog">' + 
            '<div class="modal-content">' + 
              '<div class="modal-header">' + 
                '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>' + 
                '<h4 class="modal-title">{{ title }}</h4>' + 
              '</div>' + 
              '<div class="modal-body" ng-transclude></div>' + 
            '</div>' + 
          '</div>' + 
        '</div>',
      restrict: 'E',
      transclude: true,
      replace:true,
      scope:true,
      link: function postLink(scope, element, attrs) {
        scope.title = attrs.title;

        scope.$watch(attrs.visible, function(value){
          if(value == true)
            $(element).modal('show');
          else
            $(element).modal('hide');
        });

        $(element).on('shown.bs.modal', function(){
          scope.$apply(function(){
            scope.$parent[attrs.visible] = true;
          });
        });

        $(element).on('hidden.bs.modal', function(){
          scope.$apply(function(){
            scope.$parent[attrs.visible] = false;
          });
        });
      }
    };
  });

/*erpapp.controller("LoginController", function($scope, $state){
    $scope.doLogin = function(){
        $state.go("admin");
    }
})*/