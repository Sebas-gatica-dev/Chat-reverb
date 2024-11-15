import './bootstrap';

import 'livewire-sortable';

import sort from '@alpinejs/sort'
import mask from '@alpinejs/mask'
import focus from '@alpinejs/focus'
 
Alpine.plugin(focus)
Alpine.plugin(mask)
Alpine.plugin(sort)

Livewire.on('openNewTab', url => {
    window.open(url.url, '_blank');
});

document.addEventListener("alpine:init",(()=>{Alpine.store("notification",{open:!1,message:"",type:"",timeout:null,init(){this.checkSessionForNotification()},toggle(){this.open=!this.open,!this.open&&this.timeout&&(clearTimeout(this.timeout),this.timeout=null)},showMessage(t,e="info"){this.message=t,this.type=e,this.open=!0,this.timeout&&clearTimeout(this.timeout),this.timeout=setTimeout((()=>{this.closeNotification()}),5e3)},closeNotification(){this.open=!1,this.message="",this.type="",this.timeout&&(clearTimeout(this.timeout),this.timeout=null)},checkSessionForNotification(){const t=JSON.parse(document.querySelector('meta[name="session-notification"]').content||"{}");t.message&&this.showMessage(t.message,t.type||"info")}})})),window.addEventListener("notification",(t=>{let e=t.detail;Array.isArray(e)&&(e=e[0]),console.log(e),Alpine.store("notification").showMessage(e.message||"Default message",e.type||"info")}));
