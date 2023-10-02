async function getSalonCartDetailByOrderNo(salonid, orderno) {
    try {
      let options = {
        headers: {
          'Authorization': `Bearer ${token}`
        }
      };
      let url = window._adminApi + "/salon/search?s=GetSalonCartDetailByOrderNo&idsalon=" + salonid + "&orderno=" + orderno ;
      let dataResults = null
      let response = await fetch(url, options);
    //   if(response.status !== 200){
    //      // Redirect to the new page
    //      return window.location.href = window._rootPath + "/404";
    //   }
      return dataResults = await response.json(); 
    } catch (error) {
      alert(error);
      ///Check token expired
    }
}
function formatTimeService(date) {
	let hour = date.getHours();
	const minute = date.getMinutes();

	const ampm = hour >= 12 ? "PM" : "AM";
	hour %= 12;
	hour = hour || 12;

	const formattedTime = `${hour.toString().padStart(2, "0")}:${minute
    .toString()
    .padStart(2, "0")} ${ampm}`;
	return formattedTime;
}
$(document).ready(async function () {
    const url = new URL(window.location.href);
    const idsalon = url.searchParams.get('idsalon');
    const orderno = url.searchParams.get('orderno');
    // const id = url.pathname.split('/').pop();
    // let localStorageOrder = JSON.parse(localStorage.getItem('order'));
    // let order = localStorageOrder.find((item) => item.id === id);
     let dataOrder = await getSalonCartDetailByOrderNo(idsalon, orderno);
     if(!dataOrder.error && dataOrder.data){
        let options = {
            weekday: "long",
            year: "numeric",
            month: "long",
            day: "numeric",
        };
        let orderDate = new Date(dataOrder.data.createddate).toLocaleDateString(
            "en-US",
            options
        );

        $("[data-order_date]").text(orderDate);
        $("[data-booking_date]").text(orderDate);
        $("[data-order_number]").text("#" + orderno);
        $("[data-order_total]").text(dataOrder.data.grandtotal);
        $("[data-salon_name]").text(dataOrder.data.salonname);
        $("[data-customer-count]").text(`Customer Details (${dataOrder.data.datadetail.length} person)`);

        let listCustomerDetails = document.getElementById("list-customer-details");
        listCustomerDetails.innerHTML = "";
        let templateCustomerDetail = document.getElementById("template-customer-detail");
        for (let index = 0; index < dataOrder.data.datadetail.length; index++) {
            const guest = dataOrder.data.datadetail[index];
            let startBookingTime = "";
            let endBookingTime = "";
            for (let y = 0; y < guest.services.length; y++) {
                
                let services = guest.services[y]
          
                if(startBookingTime === ""){
                    startBookingTime = services.datefrom;
                }
                else{
                    if (startBookingTime > services.datefrom)
				        startBookingTime = services.datefrom;
                }

                if(endBookingTime === "")
                endBookingTime = services.dateto;
                else{
                    if (endBookingTime < services.dateto)
                         endBookingTime = services.dateto;
                }
                
            }
            let div = templateCustomerDetail.content.cloneNode(true);
            div.querySelector("[data-customer_name]").textContent = guest.customername
            div.querySelector("[data-customer_booking_time]").textContent = `${formatTimeService(new Date(startBookingTime))}  -  ${formatTimeService(new Date(endBookingTime))}`
            listCustomerDetails.append(div)
        }
        $("[data-note]").text(dataOrder.data.note);
        $("[data-order_subtotal]").text(dataOrder.data.subtotal);
        $("[data-order_tax]").text(dataOrder.data.tax);
        $("[data-other_charges]").text(dataOrder.data.othercharge);
        $("[data-amount_paid]").text('$0.00');
     }

  
     //let orderSubTotal = order.data.subtotal;
    // let orderTax = 10;
    // let otherCharges = 15;
    // let amountPaid = 15;
    // let orderTotal = orderSubTotal + orderTax + otherCharges

   
   

    

    
    //Wednesday, May 10, 2023
    //Salon Name
    //icon clock & icon info

    // Logout or Expired : Clear Localstogred
})