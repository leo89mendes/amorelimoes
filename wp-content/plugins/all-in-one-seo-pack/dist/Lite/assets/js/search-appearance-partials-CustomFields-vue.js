(window["aioseopjsonp"]=window["aioseopjsonp"]||[]).push([["search-appearance-partials-CustomFields-vue","search-appearance-partials-lite-CustomFields-vue"],{"0ee8":function(t,e,s){},"3a4e":function(t,e,s){"use strict";s.r(e);var i=function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div",{staticClass:"aioseo-sa-ct-custom-fields-view"},[t.isUnlicensed?t._e():s("custom-fields",{attrs:{type:t.type,object:t.object,options:t.options,"show-bulk":t.showBulk}}),t.isUnlicensed?s("custom-fields-lite",{attrs:{type:t.type,object:t.object,options:t.options,"show-bulk":t.showBulk}}):t._e()],1)},o=[],n=s("5530"),r=s("2f62"),c=s("9e7b"),a={components:{CustomFields:c["default"],CustomFieldsLite:c["default"]},props:{type:{type:String,required:!0},object:{type:Object,required:!0},options:{type:Object,required:!0},showBulk:Boolean},computed:Object(n["a"])({},Object(r["c"])(["isUnlicensed"]))},l=a,u=s("2877"),d=Object(u["a"])(l,i,o,!1,null,null,null);e["default"]=d.exports},"7c50":function(t,e,s){"use strict";var i=s("0ee8"),o=s.n(i);o.a},"9e7b":function(t,e,s){"use strict";s.r(e);var i=function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div",{staticClass:"aioseo-sa-ct-custom-fields"},[s("core-blur",[s("core-settings-row",{attrs:{name:t.strings.customFields,align:""},scopedSlots:t._u([{key:"content",fn:function(){return[s("base-textarea",{attrs:{"min-height":200}}),s("div",{staticClass:"aioseo-description"},[t._v(" "+t._s(t.strings.customFieldsDescription)+" ")])]},proxy:!0}])})],1),s("cta",{attrs:{"cta-link":t.$links.getPricingUrl("custom-fields","custom-fields-upsell",t.object.name+"-post-type"),"button-text":t.strings.ctaButtonText,"learn-more-link":t.$links.getUpsellUrl("custom-fields",t.object.name,"home")},scopedSlots:t._u([{key:"header-text",fn:function(){return[t._v(" "+t._s(t.strings.ctaHeader)+" ")]},proxy:!0},{key:"description",fn:function(){return[t._v(" "+t._s(t.strings.ctaDescription)+" ")]},proxy:!0}])})],1)},o=[],n=(s("7db0"),s("5530")),r=s("2f62"),c={props:{type:{type:String,required:!0},object:{type:Object,required:!0}},data:function(){return{strings:{customFields:this.$t.__("Custom Fields",this.$td),customFieldsDescription:this.$t.__("List of custom field names to include in the SEO Page Analysis. Add one per line.",this.$td),ctaDescription:this.$t.sprintf(this.$t.__("%1$s %2$s gives you advanced customizations for our page analysis feature, letting you add custom fields to analyze.",this.$td),"AIOSEO","Pro"),ctaButtonText:this.$t.__("Upgrade to Pro and Unlock Custom Fields",this.$td),ctaHeader:this.$t.sprintf(this.$t.__("Custom Fields are only available for licensed %1$s %2$s users.",this.$td),"AIOSEO","Pro")}}},computed:Object(n["a"])({},Object(r["e"])(["options"])),methods:{getSchemaTypeOption:function(t){return this.schemaTypes.find((function(e){return e.value===t}))}}},a=c,l=(s("7c50"),s("2877")),u=Object(l["a"])(a,i,o,!1,null,null,null);e["default"]=u.exports}}]);