(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["staffs"],{"0966":function(t,e,a){"use strict";a.r(e);var r=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",[a("div",{staticClass:"flex flex-wrap"},[a("breadcrumb",{attrs:{breadcrumbs:[{to:"/",name:"ダッシュボード"},{to:null,name:"管理ユーザー一覧"}]}}),a("div",{staticClass:"w-full relative"},[a("page-title",{staticClass:"w-full mb-4",attrs:{title:"管理ユーザー一覧",icon:"users"}}),a("div",{staticClass:"absolute top-0 right-0 -mt-5 mr-5"},[a("router-link",{staticClass:"rounded-full h-8 w-8 flex items-center justify-center t-button border block rounded inline-flex items-center justify-center px-6 py-6 text-white bg-teal-500 border-teal-500 hover:bg-teal-600 hover:border-teal-600",attrs:{to:"/staff/create"}},[a("span",[a("font-awesome-icon",{attrs:{icon:["fas","plus"],size:"lg"}})],1)])],1)],1),a("t-card",{staticClass:"w-full mb-4"},[a("div",{staticClass:"flex flex-wrap"},[a("div",{staticClass:"w-full lg:w-1/3 lg:px-2"},[a("t-input-group",{attrs:{label:"名前"}},[a("t-input",{attrs:{type:"text",label:"名前",autofocus:"",autocapitalize:"off"},on:{change:function(e){return t.fetch(1)}},model:{value:t.form.name,callback:function(e){t.$set(t.form,"name",e)},expression:"form.name"}})],1)],1),a("div",{staticClass:"w-full lg:w-1/3 lg:px-2"},[a("t-input-group",{attrs:{label:"メールアドレス"}},[a("t-input",{attrs:{type:"text",label:"メールアドレス",autofocus:""},on:{change:function(e){return t.fetch(1)}},model:{value:t.form.email,callback:function(e){t.$set(t.form,"email",e)},expression:"form.email"}})],1)],1),a("div",{staticClass:"w-full lg:w-1/3 lg:px-2"},[a("t-input-group",{attrs:{label:"権限"}},[a("t-select",{attrs:{name:"role",options:t.adminRoleOption},on:{change:function(e){return t.fetch(1)}},model:{value:t.form.role,callback:function(e){t.$set(t.form,"role",e)},expression:"form.role"}})],1)],1)])]),a("t-table",{attrs:{headers:["ID","名称","メールアドレス","権限",""],data:t.list,responsive:!0,"responsive-breakpoint":1024,"tbody-class":{tbody:"border-t lg:border-0",tr:"border-0 lg:border-t",td:"p-3"}},scopedSlots:t._u([{key:"tbody",fn:function(e){var r=e.tbodyClass,l=e.trClass,o=e.tdClass,s=e.thClass,n=e.renderResponsive,i=e.data;return[n?t._l(i,(function(e,n){return a("tbody",{key:n,class:[r,n%2===0?"bg-gray-100":""]},[a("tr",{class:l},[a("th",{class:s},[t._v("ID")]),a("td",{class:[o,"relative"]},[a("t-dropdown",{staticClass:"absolute right-0 top-0",attrs:{"visible-arrow":!1,placement:"left-start",variant:"tertiary"},scopedSlots:t._u([{key:"button-content",fn:function(){return[a("font-awesome-icon",{staticClass:"text-gray-800",attrs:{icon:["fas","ellipsis-h"],size:"lg"}})]},proxy:!0}],null,!0)},[a("router-link",{staticClass:"block hover:text-white text-gray-800 px-4 py-2 hover:bg-blue-500 w-full text-left",attrs:{to:"/staff/"+e.id+"/edit"}},[t._v(" 編集 ")]),0!==parseInt(e.role.value)?a("button",{staticClass:"block hover:text-white text-gray-800 px-4 py-2 hover:bg-blue-500 w-full text-left",on:{click:function(a){return a.preventDefault(),t.onClickDelete(e.id)}}},[t._v(" 削除 ")]):t._e()],1),t._v(" "+t._s(e.id)+" ")],1)]),a("tr",{class:l},[a("th",{class:s},[t._v("名称")]),a("td",{class:[o,"relative"]},[t._v(" "+t._s(e.name)+" ")])]),a("tr",{class:l},[a("th",{class:s},[t._v("メールアドレス")]),a("td",{class:[o,"td-overflow"]},[a("a",{staticClass:"text-gray-600 hover:underline",attrs:{href:"mailto: "+e.email}},[t._v(t._s(e.email))])])]),a("tr",{class:l},[a("th",{class:s},[t._v("権限")]),a("td",{class:[o]},[a("span",{staticClass:"d-flex py-2 px-5 text-sm rounded-full font-bold",class:["bg-"+e.role.color+"-200 text-"+e.role.color+"-900"]},[t._v(" "+t._s(e.role.description)+" ")])])])])})):t._e()]}},{key:"row",fn:function(e){var r=e.trClass,l=e.tdClass,o=e.rowIndex,s=e.row;return[a("tr",{class:[r,o%2===0?"bg-gray-100":""]},[a("td",{class:[l]},[t._v(" "+t._s(s.id)+" ")]),a("td",{class:[l]},[t._v(" "+t._s(s.name)+" ")]),a("td",{class:l},[a("a",{staticClass:"text-gray-600 hover:underline",attrs:{href:"mailto: "+s.email}},[t._v(t._s(s.email))])]),a("td",{class:[l,"text-center"]},[a("span",{staticClass:"d-flex py-2 px-5 text-sm rounded-full font-bold",class:["bg-"+s.role.color+"-200 text-"+s.role.color+"-900"]},[t._v(" "+t._s(s.role.description)+" ")])]),a("td",{class:[l,"text-right"]},[a("t-dropdown",{attrs:{"visible-arrow":!1,placement:"bottom-end",variant:"tertiary"},scopedSlots:t._u([{key:"button-content",fn:function(){return[a("font-awesome-icon",{staticClass:"text-gray-800",attrs:{icon:["fas","ellipsis-h"],size:"lg"}})]},proxy:!0}],null,!0)},[a("router-link",{staticClass:"block hover:text-white text-gray-800 px-4 py-2 hover:bg-blue-500 w-full text-left",attrs:{to:"/staff/"+s.id+"/edit"}},[t._v(" 編集 ")]),0!==parseInt(s.role.value)?a("button",{staticClass:"block hover:text-white text-gray-800 px-4 py-2 hover:bg-blue-500 w-full text-left",on:{click:function(e){return e.preventDefault(),t.onClickDelete(s.id)}}},[t._v(" 削除 ")]):t._e()],1)],1)])]}},t.pagination?{key:"tfoot",fn:function(e){var r=e.tfootClass,l=e.trClass,o=e.tdClass,s=e.renderResponsive;return[a("tfoot",{class:r},[a("tr",{class:l},[a("td",{class:o,attrs:{colspan:s?2:4}},[a("t-pagination",{class:{"ml-auto":!s,"mx-auto":s},attrs:{"hide-prev-next-controls":s,"total-items":t.pagination.total,"per-page":t.pagination.perPage},model:{value:t.page,callback:function(e){t.page=e},expression:"page"}})],1)])])]}}:null],null,!0)})],1),a("confirm-modal",t._b({ref:"confirmModal"},"confirm-modal",t.confirmModel,!1,!0))],1)},l=[],o=(a("a4d3"),a("4de4"),a("e439"),a("dbb4"),a("b64b"),a("159b"),a("ade3")),s=a("2f62"),n=a("ba6a"),i=a("89dd"),c=a("2fbc"),u=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("t-modal",{ref:"modal",attrs:{"wrapper-class":"bg-orange-100 border-orange-400 text-orange-700 rounded shadow-xl flex flex-col","overlay-class":"z-40 overflow-auto left-0 top-0 bottom-0 right-0 w-full h-full fixed bg-orange-200 opacity-75","body-class":"text-xl flex flex-col items-center justify-center p-6 flex-grow",footerClass:"bg-orange-400 p-3 flex justify-between",show:""},scopedSlots:t._u([{key:"footer",fn:function(){return[a("t-button",{attrs:{variant:"tertiary","tertiary-class":"border block text-white border-transparent hover:text-gray-300"},on:{click:t.onClickCancel}},[t._v(" "+t._s(t.cancelText)+" ")]),a("t-button",{attrs:{variant:"warning"},on:{click:t.onClickOk}},[t._v(" "+t._s(t.okText)+" ")])]},proxy:!0}])},[a("h1",{staticClass:"text-xl font-bold mb-2"},[t._v(" "+t._s(t.title)+" ")]),a("p",[t._v(" "+t._s(t.message)+" ")])])},f=[],d={props:{title:{type:String,require:!0,default:null},message:{type:String,require:!1,default:null},okText:{type:String,require:!1,default:"OK"},cancelText:{type:String,require:!1,default:"キャンセル"},okFunction:{type:Function,require:!1,default:function(){}},cancelFunction:{type:Function,require:!1,default:function(){}}},methods:{show:function(){this.$refs.modal.show()},onClickOk:function(){this.$refs.modal.hide(),this.okFunction()},onClickCancel:function(){this.$refs.modal.hide(),this.cancelFunction()}}},p=d,b=a("2877"),g=Object(b["a"])(p,u,f,!1,null,null,null),m=g.exports;function v(t,e){var a=Object.keys(t);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(t);e&&(r=r.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),a.push.apply(a,r)}return a}function h(t){for(var e=1;e<arguments.length;e++){var a=null!=arguments[e]?arguments[e]:{};e%2?v(Object(a),!0).forEach((function(e){Object(o["a"])(t,e,a[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(a)):v(Object(a)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(a,e))}))}return t}var x={components:{PageTitle:i["a"],Breadcrumb:c["a"],ConfirmModal:m},data:function(){return{form:{name:null,email:null,role:null},list:[],page:1,pagination:null,confirmModel:{title:"管理ユーザー削除",message:"",okText:"削除する"}}},created:function(){this.fetch()},computed:h({},Object(s["c"])({adminRoleOption:"config/adminRoleOption"})),watch:{page:function(t,e){t!=e&&this.fetch(t)}},methods:h({fetch:function(t){var e=this,a=this.form;t&&(a["page"]=t),this.showOverlayLoading(),n["a"].get("/api/staffs",{params:a}).then((function(t){var a=t.data||null;a&&(e.list=a.data,e.pagination=a.pagination,e.page=e.pagination.currentPage),e.hideOverlayLoading()}))},onClickDelete:function(t){var e=this;this.confirmModel.message="ID: ".concat(t,"のユーザーを削除しますか？"),this.confirmModel.okFunction=function(){e.showOverlayLoading(),n["a"].delete("/api/staff/".concat(t)).then((function(){e.fetch(1)}))},this.$refs.confirmModal.show()}},Object(s["b"])({showOverlayLoading:"showOverlayLoading",hideOverlayLoading:"hideOverlayLoading"}))},y=x,w=Object(b["a"])(y,r,l,!1,null,null,null);e["default"]=w.exports},"2fbc":function(t,e,a){"use strict";var r=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{staticClass:"breadcrumb-nav"},[a("nav",{staticClass:"container"},[a("ol",{staticClass:"breadcrumb"},t._l(t.breadcrumbs,(function(e){return a("li",{key:e.name},[e.to?a("router-link",{attrs:{to:e.to}},[t._v(" "+t._s(e.name)+" ")]):a("span",[t._v(" "+t._s(e.name)+" ")])],1)})),0)])])},l=[],o={props:{breadcrumbs:{type:Array,require:!0,default:null}}},s=o,n=(a("9df7"),a("2877")),i=Object(n["a"])(s,r,l,!1,null,"b9cce3dc",null);e["a"]=i.exports},"89dd":function(t,e,a){"use strict";var r=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{staticClass:"w-full bg-white shadow rounded p-4 border-b-4 border-teal-500"},[a("h1",{staticClass:"font-bold text-lg"},[t.icon?a("font-awesome-icon",{staticClass:"text-teal-500 mr-2",attrs:{icon:["fas",t.icon],size:"lg"}}):t._e(),t._v(" "+t._s(t.title)+" ")],1)])},l=[],o={props:{title:{type:String,require:!0,default:null},icon:{type:String,require:!1,default:null}}},s=o,n=a("2877"),i=Object(n["a"])(s,r,l,!1,null,null,null);e["a"]=i.exports},"9df7":function(t,e,a){"use strict";var r=a("9ec0"),l=a.n(r);l.a},"9ec0":function(t,e,a){}}]);
//# sourceMappingURL=staffs.353fdbbb.js.map