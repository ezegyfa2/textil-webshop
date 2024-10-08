import{_ as k}from"./MainLayout.vue_vue_type_script_setup_true_lang-CQNhcmtc.js";import{a as N}from"./AddNotification-NyjqDbEZ.js";import{s as P}from"./Helpers-DvfwWfi1.js";import{d as v,n as q,p as D,r as u,q as T,s as U,o as _,c as h,b as t,k as a,e as o,v as w,t as i,u as R,j as S,h as y,V as r,x as m,f as $,y as A,g as B}from"./app-CB06vJSy.js";import"./Notifications.vue_vue_type_style_index_0_lang-DOp5nevM.js";const F={class:"text-body-2 main-text"},I={class:"text-body-2 text-center main-text"},M={class:"text-body-2 text-center main-text"},O={class:"text-body-2 text-center main-text"},j=v({__name:"CartItemsTable",props:q({cart_id:{}},{loading:{},loadingModifiers:{}}),emits:["update:loading"],setup(f){const c=f,{mdAndUp:n}=D(),e=u(1),p=u([]),x=u(0),g=u(5),b=T(f,"loading"),V=U(()=>{const d=[{key:"image"},{title:"",key:"name"},{key:"price"},{key:"quantity"}];return n.value&&d.push({key:"subtotal"}),d});function C(){axios.get(route("admin.cart.fetch-items",{page:e.value,per_page:g.value,cart_id:c.cart_id})).then(d=>{p.value=d.data.data,x.value=d.data.meta.total}).catch(d=>{console.error(d),N("A apărut o eroare neașteptată în timpul încărcării datelor","error"),p.value=[],x.value=1}).finally(()=>{b.value=!1})}return(d,l)=>(_(),h(S,{page:e.value,"onUpdate:page":l[0]||(l[0]=s=>e.value=s),"items-per-page":g.value,"onUpdate:itemsPerPage":l[1]||(l[1]=s=>g.value=s),items:p.value,"items-length":x.value,headers:V.value,"first-icon":"","last-icon":"","hide-default-footer":x.value<=10,"disable-sort":"","onUpdate:options":C},{"header.image":t(({column:s})=>l[2]||(l[2]=[a("p",{class:"text-h6 main-text"},"Produs",-1)])),"header.price":t(({column:s})=>l[3]||(l[3]=[a("p",{class:"text-h6 text-center main-text"},"Preț",-1)])),"header.quantity":t(({column:s})=>l[4]||(l[4]=[a("p",{class:"text-h6 text-center main-text"},"Cantitate",-1)])),"header.subtotal":t(({column:s})=>l[5]||(l[5]=[a("p",{class:"text-h6 text-center main-text"},"Subtotal",-1)])),"item.image":t(({item:s})=>[o(w,{class:"my-2",src:s.product.image_src,height:"100",width:"100",cover:""},null,8,["src"])]),"item.name":t(({item:s})=>[a("p",F,i(R(P)(s.product.name)),1)]),"item.price":t(({item:s})=>[a("p",I,i(s.product.price.toFixed(2))+" RON",1)]),"item.quantity":t(({item:s})=>[a("p",M,i(s.quantity),1)]),"item.subtotal":t(({item:s})=>[a("p",O,i((s.product.price*s.quantity).toFixed(2))+" RON",1)]),"no-data":t(()=>l[6]||(l[6]=[a("p",{class:"text-body-1 pt-8"},"Coșul este gol",-1)])),_:1},8,["page","items-per-page","items","items-length","headers","hide-default-footer"]))}}),E={class:"p-5"},H={class:"text-h5 main-text text-end"},Q=v({__name:"Show",props:{total_price:{},cart_id:{},first_name:{},last_name:{},email:{},phone:{},company_name:{},address:{},postal_code:{}},setup(f){const c=u(!1);return u([]),(n,e)=>(_(),h(k,null,{default:t(()=>[o(B,null,{default:t(()=>[o(y,{class:"my-10"},{default:t(()=>[o(r,{cols:"12"},{default:t(()=>e[1]||(e[1]=[a("p",{class:"text-h4 main-text text-uppercase"}," Detalii de facturare ",-1)])),_:1})]),_:1}),o(y,null,{default:t(()=>[o(r,{cols:"6",sm:"4"},{default:t(()=>[e[2]||(e[2]=a("p",{class:"text-h6 main-text"},"Prenume",-1)),m(" "+i(n.first_name),1)]),_:1}),o(r,{cols:"6",sm:"4"},{default:t(()=>[e[3]||(e[3]=a("p",{class:"text-h6 main-text"},"Nume",-1)),m(" "+i(n.last_name),1)]),_:1}),o(r,{cols:"6",sm:"4"},{default:t(()=>[e[4]||(e[4]=a("p",{class:"text-h6 main-text"},"Email",-1)),m(" "+i(n.email),1)]),_:1}),o(r,{cols:"6",sm:"4"},{default:t(()=>[e[5]||(e[5]=a("p",{class:"text-h6 main-text"},"Număr de telefon",-1)),m(" "+i(n.phone),1)]),_:1}),o(r,{cols:"6",sm:"4"},{default:t(()=>[e[6]||(e[6]=a("p",{class:"text-h6 main-text"},"Denumirea companiei",-1)),m(" "+i(n.company_name),1)]),_:1}),o(r,{cols:"6",sm:"4"},{default:t(()=>[e[7]||(e[7]=a("p",{class:"text-h6 main-text"},"Cod postal",-1)),m(" "+i(n.postal_code),1)]),_:1}),o(r,{cols:"6",sm:"4"},{default:t(()=>[e[8]||(e[8]=a("p",{class:"text-h6 main-text"},"Adresa",-1)),m(" "+i(n.address),1)]),_:1}),o(r,{cols:"12"},{default:t(()=>[o($,{class:"mt-10"},{default:t(()=>[o(j,{cart_id:n.cart_id,loading:c.value,"onUpdate:loading":e[0]||(e[0]=p=>c.value=p)},null,8,["cart_id","loading"]),o(A,{thickness:1,opacity:"100"}),a("div",E,[a("p",H,"Preț total: "+i(n.total_price.toFixed(2))+" RON",1)])]),_:1})]),_:1})]),_:1})]),_:1})]),_:1}))}});export{Q as default};
