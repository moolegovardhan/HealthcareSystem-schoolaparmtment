var f = angular.module("FactModule", ["ngResource"]);

f.factory("LoginFactory", function($resource){
    var users = [{"username":"Satya", "role":"admin"}]
    
    return {
        getUserDetails: function(){
            return users;
        }
    }
})

f.factory("CompanyFactory",function($resource){
    var companyInfo;
    return {
        getCompanyInfo: function(){
            return companyInfo;
        },
        addCompanyInfo: function(newcompanyinfo){
            companyInfo = newcompanyinfo;
        }
    }
})

f.factory("BranchFactory", function($resource){
    var allbranches = [];
    
    return {
        getAllBranches: function(){
            return allbranches;
        },
        addBranch: function(newbranch){
            allbranches.push(newbranch);
        },
        deleteBranch: function(idx){
            allbranches.splice(idx, 1);
        },
        updateBranch: function(idx, branch){
            allbranches[idx] = branch;
        }
    }
})

f.factory("LocationFactory", function($resource){
    var alllocations = [];
    
    return {
        getAllLocations: function(){
            return alllocations;
        },
        addLocation: function(newlocation){
            alllocations.push(newlocation);
        },
        deleteLocation: function(idx){
            alllocations.splice(idx, 1);
        },
        updateLocation: function(idx, location){
            alllocations[idx] = location;
        }
    }
})

f.factory("SupplierFactory", function($resource){
    var allsuppliers = [];
    
    return {
        getAllSuppliers: function(){
            return allsuppliers;
        },
        addSupplier: function(newsupplier){
            allsuppliers.push(newsupplier);
        },
        deleteSupplier: function(idx){
            allsuppliers.splice(idx, 1);
        },
        updateSupplier: function(idx, supplier){
            allsuppliers[idx] = supplier;
        }
    }
})

f.factory("CategoryFactory", function($resource){
    var allcategories = [];
    
    return {
        getAllCategories: function(){
            return allcategories;
        },
        addCategory: function(newcategory){
            allcategories.push(newcategory);
        },
        deleteCategory: function(idx){
            allcategories.splice(idx, 1);
        },
        updateCategory: function(idx, category){
            allcategories[idx] = category;
        }
    }
})

f.factory("SubCategoryFactory", function($resource){
    var allsubcategories = [];
    
    return {
        getAllSubCategories: function(){
            return allsubcategories;
        },
        addSubCategory: function(newsubcategory){
            allsubcategories.push(newsubcategory);
        },
        deleteSubCategory: function(idx){
            allsubcategories.splice(idx, 1);
        },
        updateSubCategory: function(idx, subcategory){
            allsubcategories[idx] = subcategory;
        }
    }
})

f.factory("InwardFactory", function($resource){
    var allinwards = [];
    
    return {
        getAllInwards: function(){
            return allinwards;
        },
        addInward: function(newinward){
            allinwards.push(newinward);
        },
        deleteInward: function(idx){
            allinwards.splice(idx, 1);
        },
        updateInward: function(idx, inward){
            allinwards[idx] = inward;
        }
    }
})

f.factory("MedicineFactory", function($resource){
    var allmedicines = [];
    
    return {
        getAllMedicines: function(){
            return allmedicines;
        },
        addMedicine: function(newmedicine){
            allmedicines.push(newmedicine);
        },
        deleteMedicine: function(idx){
            allmedicines.splice(idx, 1);
        },
        updateMedicine: function(idx, medicine){
            allmedicines[idx] = medicine;
        }
    }
})