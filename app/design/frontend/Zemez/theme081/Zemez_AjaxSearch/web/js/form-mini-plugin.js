define([
    'jquery',
    'jquery/ui',
    'Magento_Search/form-mini',
    'Zemez_AjaxSearch/js/tm-search-ajax'
], function($) {
    'use strict';

    $.widget('Zemez.formMiniPlugin', $.tm.quickSearchAjax, {

        setActiveState: function (isActive) {
            
        },

        _create: function() {
            this._super();
        }

    });

    return $.Zemez.formMiniPlugin;
});