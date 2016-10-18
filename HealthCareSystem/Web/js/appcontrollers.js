var c = angular.module("CtrlModule", ["FactModule"]);

c.run(function($rootScope){
    $rootScope.status = "";
})


c.controller("LoginController", function($scope, $state, LoginFactory){
    $scope.doLogin = function(){
        console.log("Helo in login ");
        var userInfo = LoginFactory.getUserDetails();
        //if(userInfo.role == "admin") {
            $state.go("admin.dashboard");    
        //}
        
    }
})

c.controller("CompanyController", function($scope, CompanyFactory, $rootScope){
    $rootScope.status = "";
    $scope.newcompany = {};
    $scope.submitCompany = function(){
        CompanyFactory.addCompanyInfo($scope.newcompany);
        $scope.newcompany={};
        $rootScope.status = "Save Done!"
    }
    $scope.viewCompany = function(){
        $scope.newcompany = angular.copy(CompanyFactory.getCompanyInfo());
    }
})

c.controller("BranchController", function($scope, BranchFactory, $rootScope){
    $rootScope.status = "";
    $scope.newbranch = {};
    $scope.branches = BranchFactory.getAllBranches();
    var editFlag = false;
    var idx;
    $scope.saveBranch = function(){
        if(!editFlag) {
            BranchFactory.addBranch($scope.newbranch);    
        } else {
            BranchFactory.updateBranch(idx, $scope.newbranch);    
            editFlag = false;
        }
        $scope.newbranch = {};
        $rootScope.status = "Save Done!";
    }
    
    $scope.editBranch = function(indx, branch){
        $scope.newbranch = angular.copy(branch);
        idx = indx;
        editFlag = true;
    }
    
    $scope.deleteBranch =function(indx){
        BranchFactory.deleteBranch(indx);
    }
})

c.controller("LocationController", function($scope, LocationFactory, $rootScope){
    $rootScope.status = "";
    $scope.newlocation = {};
    $scope.locations = LocationFactory.getAllLocations();
    var editFlag = false;
    var idx;
    $scope.saveLocation = function(){
        if(!editFlag) {
            LocationFactory.addLocation($scope.newlocation);    
        } else {
            LocationFactory.updateLocation(idx, $scope.newlocation);    
            editFlag = false;
        }
        $scope.newlocation = {};
        $rootScope.status = "Save Done!";
    }
    
    $scope.editLocation = function(indx, location){
        $scope.newlocation = angular.copy(location);
        idx = indx;
        editFlag = true;
    }
    
    $scope.deleteLocation =function(indx){
        LocationFactory.deleteLocation(indx);
    }
})

c.controller("SupplierController", function($scope, SupplierFactory, $rootScope){
    $rootScope.status = "";
    $scope.newsupplier = {};
    $scope.suppliers = SupplierFactory.getAllDealers();
    var editFlag = false;
    var idx;
    $scope.saveSupplier = function(){
        if(!editFlag) {
            SupplierFactory.addSupplier($scope.newsupplier);    
        } else {
            SupplierFactory.updateSupplier(idx, $scope.newsupplier);    
            editFlag = false;
        }
        $scope.newsupplier = {};
        $rootScope.status = "Save Done!";
    }
    
    $scope.editSupplier = function(indx, supplier){
        $scope.newsupplier = angular.copy(supplier);
        idx = indx;
        editFlag = true;
    }
    
    $scope.deleteSupplier =function(indx){
        SupplierFactory.deleteSupplier(indx);
    }
})

c.controller("CategoryController", function($scope, CategoryFactory, $rootScope){
    $rootScope.status = "";
    $scope.newcategory = {};
    $scope.categories = CategoryFactory.getAllCategories();
    var editFlag = false;
    var idx;
    $scope.saveCategory = function(){
        if(!editFlag) {
            CategoryFactory.addCategory($scope.newcategory);    
        } else {
            CategoryFactory.updateCategory(idx, $scope.newcategory);    
            editFlag = false;
        }
        $scope.newcategory = {};
        $rootScope.status = "Save Done!";
    }
    
    $scope.editCategory = function(indx, category){
        $scope.newcategory = angular.copy(category);
        idx = indx;
        editFlag = true;
    }
    
    $scope.deleteCategory =function(indx){
        CategoryFactory.deleteCategory(indx);
    }
})

c.controller("SubCategoryController", function($scope, SubCategoryFactory, $rootScope){
    $rootScope.status = "";
    $scope.newsubcategory = {};
    $scope.subcategories = SubCategoryFactory.getAllSubCategories();
    var editFlag = false;
    var idx;
    $scope.saveSubCategory = function(){
        if(!editFlag) {
            SubCategoryFactory.addSubCategory($scope.newsubcategory);    
        } else {
            SubCategoryFactory.updateSubCategory(idx, $scope.newsubcategory);    
            editFlag = false;
        }
        $scope.newsubcategory = {};
        $rootScope.status = "Save Done!";
    }
    
    $scope.editSubCategory = function(indx, subcategory){
        $scope.newsubcategory = angular.copy(subcategory);
        idx = indx;
        editFlag = true;
    }
    
    $scope.deleteSubCategory =function(indx){
        SubCategoryFactory.deleteSubCategory(indx);
    }
})

c.controller("InwardController", function($scope, InwardFactory, $rootScope){
    $rootScope.status = "";
    $scope.newinward = {};
    $scope.inwards = InwardFactory.getAllInwards();
    var editFlag = false;
    var idx;
    $scope.saveInward = function(){
        if(!editFlag) {
            InwardFactory.addInward($scope.newinward);    
        } else {
            InwardFactory.updateInward(idx, $scope.newinward);    
            editFlag = false;
        }
        $scope.newinward = {};
        $rootScope.status = "Save Done!";
    }
    
    $scope.editInward = function(indx, inward){
        $scope.newinward = angular.copy(inward);
        idx = indx;
        editFlag = true;
    }
    
    $scope.deleteInward =function(indx){
        InwardFactory.deleteInward(indx);
    }
})

c.controller("MedicineController", function($scope, MedicineFactory, $rootScope){
    $rootScope.status = "";
    $scope.newmedicine = {};
    $scope.medicines = MedicineFactory.getAllMedicines();
    var editFlag = false;
    var idx;
    $scope.saveMedicine = function(){
        if(!editFlag) {
            MedicineFactory.addMedicine($scope.newmedicine);    
        } else {
            MedicineFactory.updateMedicine(idx, $scope.newmedicine);    
            editFlag = false;
        }
        $scope.newmedicine = {};
        $rootScope.status = "Save Done!";
    }
    
    $scope.editMedicine = function(indx, medicine){
        $scope.newmedicine = angular.copy(medicine);
        idx = indx;
        editFlag = true;
    }
    
    $scope.deleteMedicine =function(indx){
        MedicineFactory.deleteMedicine(indx);
    }
})

c.controller("POController", function($scope){
    $scope.products = [{"code": "C4320", "name":"Crocin 500", "inventory": 7},
                      {"code": "P3310", "name":"Paracetamol", "inventory": 15},
                      {"code": "B4312", "name":"B Complex", "inventory": 207},
                      {"code": "X4312", "name":"Benedryl", "inventory": 156},
                      {"code": "A1320", "name":"Combiflam", "inventory": 307}]
})

c.controller("InvoiceController", function($scope){
    $scope.invoicedetails = [{"invoiceno":"TG101", "PONo": "PT30201", "Date": "13-Jan-16", "supplier":"Pfizer","PaymentMode": "Cash", "OrderAmt": 300000},
                    {"invoiceno":"UG301", "PONo": "PT45201", "Date": "14-Jan-16", "supplier":"Pfizer","PaymentMode": "Cheque", "OrderAmt": 200000},
                    {"invoiceno":"TG102", "PONo": "PT45202", "Date": "15-Jan-16", "supplier":"Pfizer","PaymentMode": "Cash", "OrderAmt": 330000}]
})

c.controller("SOController", function($scope){
    $scope.sodetails = [{"sono":"TG101", "Date": "13-Jan-16", "customer":"Suresh","PaymentMode": "Cash", "OrderAmt": 300},
                    {"sono":"CG101", "Date": "13-Jan-16", "customer":"Padma","PaymentMode": "Cash", "OrderAmt": 500},
                    {"sono":"CG102", "Date": "13-Jan-16", "customer":"Prasad","PaymentMode": "Cash", "OrderAmt": 400}]
})