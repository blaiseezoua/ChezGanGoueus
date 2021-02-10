define([
    'jquery',
    'underscore',
    'text!Zemez_QuickView/templates/button.html',
    'Magento_Ui/js/modal/modal',
    'mage/translate',
    'Magento_Customer/js/customer-data',
    'mage/loader'
], function ($, _, buttonTpl) {
    'use strict';

    $.widget('tm.quickViewButton', {
        options: {
            productItemSelector: '.product-item-info',
            productLinkSelector: '> .product-item-photo:last',
            title: $.mage.__('Quick View'),
            buttonText: $.mage.__('Quick View'),
            closeButtonText: $.mage.__('Close'),
            buttonCssClass: 'quick-view',
            textIdClone: '.quick-view-trigger',
            isShowSpinner: true
        },

        modal: null,

        _create: function() {
            _.bindAll(this, '_onClickHandler', '_createModal', '_closeModal');


            var selector = this.options.productItemSelector;

            var button = _.template(buttonTpl)({
                data: this.options
            });

            $(selector).each(_.bind(function(i, product) {
                if($('button.quick-view-trigger', product).length) return true;
                $(button).on('click', this._onClickHandler).prependTo(product);
            }, this));
        },

        _onClickHandler: function(event) {


            var productItemSelector = this.options.productItemSelector,
                productLinkSelector = this.options.productLinkSelector;


            var link = $(event.target).closest(productItemSelector).find(productLinkSelector);
            var url = $(link).attr('href');

            this.dataCopyTocompare = $(event.target).closest(this.options.textIdClone).parent().find('.tocompare').attr("data-post");

            var settings = {
                method: 'GET',
                showLoader: this.options.isShowSpinner,
                data: {
                    quickView: true
                }
            };
            var successHandler = _.compose(this._createModal, _.property('content'));
            var errorHandler = _.compose(this._createModal, _.property('message'));

            $.ajax(url, settings).success(successHandler).fail(errorHandler);

        },

        _createModal: function(content) {
            this.modal = $('<div />').html(content).modal({
                title: this.options.title,
                buttons: [
                    {
                        text: this.options.closeButtonText,
                        class: 'close',
                        click: this._closeModal
                    }
                ],
                modalClass: 'quick-view',
                clickableOverlay: true
            })
            .trigger('openModal')
            .trigger('contentUpdated');
            if(require.defined("catalogAddToCart")) {
                $( "form#product_addtocart_form, .form.map.checkout" ).catalogAddToCart();
            }
            if(!compareProductAddAjax) {
                $('.modal-popup.quick-view a.tocompare').attr("data-post", this.dataCopyTocompare);
            }
        },

        _closeModal: function() {
            if (this.modal) {
                this.modal.trigger('closeModal');
                this.modal = null;
            }
        }
    });

    return $.tm.quickViewButton;
});