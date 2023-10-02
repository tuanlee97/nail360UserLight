const dataPost = {
	guest: [],
};
let guest = {};
let guestIndex = undefined;
let isAllowChangeTime = true;

function formatTime(minutes) {
	if (minutes <= 60) {
		return minutes + " ";
	} else {
		var hours = Math.floor(minutes / 60);
		var remainingMinutes = minutes % 60;
		return hours + "h " + remainingMinutes;
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

function formatDateMonth(selectedDate) {
	var formatMonth = new Intl.DateTimeFormat("en-US", {
		month: "short",
	}).format(selectedDate);
	var formatYear = new Intl.DateTimeFormat("en-US", {
		year: "numeric",
	}).format(selectedDate);
	return `${formatMonth}, ${formatYear}`;
}

function getTimeArray(start, end, interval) {
	var result = [];
	var startTime = new Date('1970-01-01 ' + start).getTime();
	var endTime = new Date('1970-01-01 ' + end).getTime();

	while (startTime <= endTime) {
		result.push(formatWorkingTime(new Date(startTime)));
		startTime += interval * 60 * 1000;
	}
	return result;
}

function formatWorkingTime(date) {
	var hours = date.getHours();
	var minutes = date.getMinutes();
	var ampm = hours >= 12 ? 'PM' : 'AM';
	hours = hours % 12;
	hours = hours ? hours : 12;
	minutes = minutes < 10 ? '0' + minutes : minutes;
	var strTime = hours + ':' + minutes + ' ' + ampm;
	return strTime;
}

function isTimePast(time) {
	var currentTime = new Date();
	var timeParts = time.split(' ');
	var timeHours = parseInt(timeParts[0].split(':')[0]);
	var timeMinutes = parseInt(timeParts[0].split(':')[1]);
	var timePeriod = timeParts[1];

	if (timePeriod === 'PM' && timeHours !== 12) {
		timeHours += 12;
	}

	var timeObject = new Date(currentTime.getFullYear(), currentTime.getMonth(), currentTime.getDate(), timeHours, timeMinutes);

	return timeObject < currentTime;
}
async function setWorkingTime(startWorkingTime, endWorkingTime, interval) {
	//Ex: startWorkingTime : '09:00 AM' ; endWorkingTime : '08:00 PM' ; interval : 30
	var times = getTimeArray(startWorkingTime, endWorkingTime, interval);
	const timeList = document.querySelector("#timeList");
	timeList.innerHTML = "";
	for (let index = 0; index < times.length; index++) {
		const time = times[index];
		let el = document.createElement("div");
		el.dataset.value = time;
		el.dataset.index = index;
		el.classList.add("item", "fsize-2");
		if (new Date().getDate() == guest.datetime.getDate() && isTimePast(time)) {
			el.classList.add("disable");
		}
		el.textContent = time
		timeList.appendChild(el);
	}
	var firstActiveTime = document.querySelector("#timeList .item:not(.disable)")
	firstActiveTime.classList.add("active"); // Add active first available
	const widthTimeItem = document.querySelector("#timeList .item").offsetWidth;
	document.getElementById("formTimeList").scrollLeft = widthTimeItem * firstActiveTime.dataset.index;

}
async function openAddService() {
	$("#add-service-form").addClass("d-none");
	// Toggle Modal
	$("#addService").modal("show");

	$("#addService .add-service-title").text("Loading");
	$("#addService #loading").html(
		'<p class="my-3 lh-16px p-color text-center">Please wait...</p><div class="spinner-border text-danger" role="status"><span class="visually-hidden">Loading...</span></div>'
	);
	let dataRender = await getSalonCategoryService(salon_id, token);
	if (!dataRender.error) {
		//Get Template
		if (dataRender.data.length > 0) {
			await loadCategoryService(dataRender.data);
		}

		// Render Form
		$("#addService .add-service-title").text("Add Service");
		$("#addService #loading").html("");
		$("#add-service-form").removeClass("d-none");
		$('input[type="radio"][name="service_selected"]').on("change", function() {
			if ($("#service_submit").prop("disabled")) {
				$("#service_submit").prop("disabled", false);
			}
		});
	}
}

async function loadCategoryService(categories) {
	let listTechnical = document.getElementById("accordion-list-technical");
	listTechnical.innerHTML = "";
	let salonCategoryServiceTemplate = document.getElementById(
		"salon_category_service"
	);
	let salonCategoryService_ItemTemplate = document.getElementById(
		"salon_category_service_item"
	);

	for (let index = 0; index < categories.length; index++) {
		let category = categories[index];
		let div = salonCategoryServiceTemplate.content.cloneNode(true);
		const category_div = div.querySelector("[data-category]");
		const collapse_div = div.querySelector("[data-collapse]");

		category_div.setAttribute("data-bs-target", "#panelsCollapse_" + index);
		category_div.setAttribute("aria-controls", "panelsCollapse_" + index);
		category_div.textContent = category.name;

		collapse_div.innerHTML = "";
		collapse_div.setAttribute("id", "panelsCollapse_" + index);

		// Item Loop
		if (category.services)
			for (
				let child_index = 0; child_index < category.services.length; child_index++
			) {
				let service = category.services[child_index];
				let divChild =
					salonCategoryService_ItemTemplate.content.cloneNode(true);
				const cbox = divChild.querySelector("[data-cb_value]");
				cbox.value = JSON.stringify(service);
				let lowerCategoryName = category.name
					.trim()
					.toLowerCase()
					.replace(" ", "_");
				divChild.querySelector("[data-service_name]").textContent =
					service.name;
				divChild.querySelector("[data-service_price]").textContent =
					service.price;
				divChild.querySelector("[data-service_minutes]").textContent =
					formatTime(parseInt(service.minutes));
				collapse_div.append(divChild);
			}
		listTechnical.append(div);
	}
}

function selectedDate() {
	$("#dateList .item").on("click", function() {
		if (isAllowChangeTime && new Date().getDate() - 1 <= $(this).index()) {
			const slider = document.querySelector("#dateList");
			const items = slider.querySelectorAll("#dateList .item");
	
			const widthItem = document.querySelector("#dateList .item").offsetWidth;
			// remove active class from all items
			items.forEach((item) => {
				item.classList.remove("active");
			});
			$(this).addClass("active");

			const newDate = guest.datetime;
			newDate.setDate($(this).data("num"));
			guest.datetime = newDate;

			const activeIndex = $("#dateList .item.active").index();
			document.getElementById("formDateList").scrollLeft = widthItem * activeIndex;
			// Set working Time

			let startWorkingTime = $(items[activeIndex]).data('start_time');
			let endWorkingTime = $(items[activeIndex]).data('end_time');
			var interval = 30;
			setWorkingTime(startWorkingTime, endWorkingTime, interval)
		}
	});
}
async function initSelectDays() {
	const slider = document.querySelector("#dateList");
	const items = slider.querySelectorAll("#dateList .item");

	const widthItem = document.querySelector("#dateList .item").offsetWidth;

	let dayOfMonth = guest.datetime.getDate();
	let currentDateIndex = dayOfMonth - 1;

	if (!isAllowChangeTime) {
		// remove active class from all items
		items.forEach((item) => {
			item.classList.remove("active");
			item.classList.add("disable");
		});
		$("#monthpicker").prop("type", "hidden");
	} else {
		for (let index = 0; index < new Date().getDate() - 1; index++) {
			const item = items[index];
			item.classList.add("disable");
		}
	}
	items[currentDateIndex].classList.remove("disable");
	items[currentDateIndex].classList.add("active");

	// Set working Time

	let startWorkingTime = $(items[currentDateIndex]).data('start_time');
	let endWorkingTime = $(items[currentDateIndex]).data('end_time');
	var interval = 30;
	await setWorkingTime(startWorkingTime, endWorkingTime, interval)

	if (dayOfMonth > 7) {
		document.getElementById("formDateList").scrollLeft = widthItem * dayOfMonth;
	}
}
async function openAddTechnician(service_selected) {
	$("#add-technician-form").addClass("d-none");
	// Toggle Modal
	$("#addTechnician").modal("show");

	$("#addTechnician .add-technician-title").text("Loading");
	$("#addTechnician #loading").html(
		'<p class="my-3 lh-16px p-color text-center">Please wait...</p><div class="spinner-border text-danger" role="status"><span class="visually-hidden">Loading...</span></div>'
	);
	// let dataTechnician = await getSalonTechnician(salon_id, token);
	// if (!dataTechnician.error) {
	//   //Get Template
	//   if (dataTechnician.data.length > 0) {
	await loadModalTechnician(service_selected);
	// }

	// Render Form
	$(".technician-service_name").text(service_selected.name);
	$("#addTechnician #loading").html("");
	$("#add-technician-form").removeClass("d-none");

	//Need Form Display to Caculate offsetWidth
	//Init Current Day : Active & Position
	await initSelectDays();
	selectedDate();
	// }
}
async function loadingBookingDetail() {
	let list_booking_ticket = document.getElementById("list_booking_ticket");
	let total = 0;
	list_booking_ticket.innerHTML = "";


	let bookingTicketTemplate = document.getElementById("booking_ticket");
	let ticketServiceTemplate = document.getElementById("ticket_service_detail");


	for (let index = 0; index < dataPost.guest.length; index++) {
		let startBookingTime = "";
		let endBookingTime = "";

		let itemGuest = dataPost.guest[index];
		let div = bookingTicketTemplate.content.cloneNode(true);
		div.querySelector("[data-ticket_guest_name]").textContent =
			itemGuest.firstname + " " + itemGuest.lastname;
		div.querySelector("[data-list_ticket_service_detail").innerHTML = "";

		let listServices = itemGuest.service_selected;
		for (let y = 0; y < listServices.length; y++) {
			let service = listServices[y];
			total += parseFloat(service.price.replace("$", ""));
			let technical = service.technical_selected;
			let startDateSelect = technical.find((item) => item.name === "date");
			let startTimeSelect = technical.find((item) => item.name === "time");
	
			let [hour, minute] = startTimeSelect.value
				.split(":")
				.map((num) => parseInt(num, 10));

			let startTime = new Date(startDateSelect.value);
			startTime.setHours(hour);
			startTime.setMinutes(minute);

			let endTime = new Date(
				new Date(startTime).setMinutes(startTime.getMinutes() + service.minutes)
			);
			if (startBookingTime === "" || startBookingTime > startTime)
				startBookingTime = startTime;
			if (endBookingTime === "" || endBookingTime < endTime)
				endBookingTime = endTime

      service.fromTime = `${itemGuest.date} ${formatTimeService(startTime)}`;
      service.toTime = `${itemGuest.date} ${formatTimeService(endTime)}`;
      service.priceService = parseFloat(service.price.replace("$", ""));
      
			let divService = ticketServiceTemplate.content.cloneNode(true);
			divService.querySelector("[data-service_times]").textContent =
				formatTimeService(startTime) + " - " + formatTimeService(endTime);
			divService.querySelector("[data-service_name]").textContent =
				service.name;
			divService.querySelector("[data-service_price]").textContent =
				service.price;
			divService.querySelector("[data-service_description]").textContent =
				"Any one";
			divService.querySelector("[data-service_duration]").innerHTML =
				'<span class="me-1"><svg height="12" aria-hidden="true" data-prefix="fal" data-icon="clock" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-clock fa-w-16 fa-7x"><path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm216 248c0 118.7-96.1 216-216 216-118.7 0-216-96.1-216-216 0-118.7 96.1-216 216-216 118.7 0 216 96.1 216 216zm-148.9 88.3l-81.2-59c-3.1-2.3-4.9-5.9-4.9-9.7V116c0-6.6 5.4-12 12-12h14c6.6 0 12 5.4 12 12v146.3l70.5 51.3c5.4 3.9 6.5 11.4 2.6 16.8l-8.2 11.3c-3.9 5.3-11.4 6.5-16.8 2.6z" class=""></path></svg></span>' +
				formatTime(service.minutes) + "ms";
			divService.querySelector(".delete-service").setAttribute("data-service_index", y);
			divService.querySelector(".delete-service").setAttribute("data-guest_index", index);
			div.querySelector("[data-list_ticket_service_detail").append(divService);
		}
		div
			.querySelector("[data-add_another_service]")
			.setAttribute("data-guest_index", index);
		list_booking_ticket.append(div);
		itemGuest.startBookingTime = formatTimeService(startBookingTime)
		itemGuest.endBookingTime = formatTimeService(endBookingTime)
	}
	dataPost.subtotal = total;

}
async function checkShowSubmit() {
	let checkAvailable = false;
	for (let index = 0; index < dataPost.guest.length; index++) {
		const element = dataPost.guest[index];
		if (element.service_selected.length > 0) {
			checkAvailable = true
			break;
		}
	}
	let checkbox_checked = $('#policy')[0].checked;
	let disabled = !(checkbox_checked && checkAvailable)
	$("#booking_detail_pay_now").prop("disabled", disabled);
	$("#booking_detail_pay_at_store").prop("disabled", disabled);
}
async function openBookingDetail() {
	$("#bookingDetail").modal("show");
	$("#bookingDetail .add-booking-detail-title").text("Loading");
	$("#bookingDetail #loading").html(
		'<p class="my-3 lh-16px p-color text-center">Please wait...</p><div class="spinner-border text-danger" role="status"><span class="visually-hidden">Loading...</span></div>'
	);
	await loadingBookingDetail();

	$("#bookingDetail .add-booking-detail-title").text("Booking Details");
	let options = {
		weekday: "long",
		year: "numeric",
		month: "long",
		day: "numeric",
	};
	let formattedDate = dataPost.guest[0].datetime.toLocaleDateString(
		"en-US",
		options
	);
	$("#bookingDetail .date_booking").text(formattedDate);
	dataPost.orderDate = formattedDate;
	$("#bookingDetail #total").text(`$${dataPost.subtotal.toFixed(2)}`);

	$("#bookingDetail #loading").html("");
	$("#add-booking-detail-form").removeClass("d-none");
	await checkShowSubmit();
	$('#policy').on("change", async function() {
		await checkShowSubmit();
	});

	$(".add-another-service").on("click", function() {
		guest = {
			...dataPost.guest[$(this).data("guest_index")]
		};
		guestIndex = $(this).data("guest_index");
		guest.service_selected = [];
		$("#bookingDetail").modal("hide");
		openAddService();
	});
	$(".btn-add-another-guest").on("click", function() {
		guest = {};
		guestIndex = undefined;
		$("#bookingDetail").modal("hide");
	
		$('#addGuest input[name="date"]').val(dataPost.guest[0].date);
		$('#addGuest input[name="date"]').prop("disabled", true);
		$("#addGuest").modal("show");
	});

	$('input[name="dateBooking"]').val(dataPost.guest[0].date);
	$(".delete-service").on("click", function() {
		let service_index = $(this).data("service_index");
		let guest_index = $(this).data("guest_index");
		let price = dataPost.guest[guest_index].service_selected[service_index].price
		let list_booking_detail_card = $("#list_booking_ticket .list-booking-detail-card");

		dataPost.guest[guest_index].service_selected.splice(service_index, 1);
		dataPost.subtotal -= parseFloat(price.replace("$", ""));

		let startBookingTime = "";
		let endBookingTime = "";

		for (let index = 0; index < dataPost.guest[guest_index].service_selected.length; index++) {
			let service = dataPost.guest[guest_index].service_selected[index];

			let technical = service.technical_selected;
			let startDateSelect = technical.find((item) => item.name === "date");
			let startTimeSelect = technical.find((item) => item.name === "time");

			let [hour, minute] = startTimeSelect.value
				.split(":")
				.map((num) => parseInt(num, 10));

			let startTime = new Date(startDateSelect.value);
			startTime.setHours(hour);
			startTime.setMinutes(minute);

			let endTime = new Date(
				new Date(startTime).setMinutes(startTime.getMinutes() + service.minutes)
			);


			if (startBookingTime === "" || startBookingTime > startTime)
				startBookingTime = startTime;
			if (endBookingTime === "" || endBookingTime < endTime)
				endBookingTime = endTime
		}
		dataPost.guest[guest_index].startBookingTime = formatTimeService(startBookingTime);
		dataPost.guest[guest_index].endBookingTime = formatTimeService(endBookingTime);

		let checkAvailable = false;
		for (let index = 0; index < dataPost.guest.length; index++) {
			const element = dataPost.guest[index];
			if (element.service_selected.length > 0) {
				checkAvailable = true
				break;
			}
		}
		isAllowChangeTime = !checkAvailable;

		let checkbox_checked = $('#policy')[0].checked;
		let disabled = !(checkbox_checked && checkAvailable)
		$("#booking_detail_pay_now").prop("disabled", disabled);
		$("#booking_detail_pay_at_store").prop("disabled", disabled);

		let booking_detail_card_item = list_booking_detail_card[guest_index].querySelectorAll(".booking-detail-card--item");
		booking_detail_card_item[service_index].remove();
		$("#bookingDetail #total").text(`$${dataPost.subtotal.toFixed(2)}`);
	
	})

	return false;
}
async function gerenateListDays() {
	const slider = document.querySelector("#dateList");
	slider.innerHTML = "";
	const now = guest.datetime;
	// const year = now.getFullYear();
	// const month = now.getMonth();
	// const daysInMonth = new Date(year, month + 1, 0).getDate();
	let dataDates = [];
	let dataSalonWorkingTime = await getSalonWorkingTime(salon_id, token, now);
	const weekdays = ['', 'SU', 'MO', 'TU', 'WE', 'TH', 'FR', 'SA'];

	for (let i = 0; i < dataSalonWorkingTime.data.length; i++) {
		const date = new Date(dataSalonWorkingTime.data[i].date);
		let dayOfWeek = weekdays[dataSalonWorkingTime.data[i].weekday];

		dataDates.push({
			number: i + 1,
			name: dayOfWeek,
		});
		let el = document.createElement("div");
		el.dataset.num = i + 1;
		el.dataset.start_time = dataSalonWorkingTime.data[i].workingtime[0].starttime;
		el.dataset.end_time = dataSalonWorkingTime.data[i].workingtime[0].endtime;
		el.classList.add("item");
		el.innerHTML =
			'<span class="fsize-2 p-color text-uppercase">' +
			dayOfWeek +
			"</span>" +
			'<span class="mulish-bold fsize-2 h-color">' +
			`${i + 1}` +
			"</span>";
		slider.appendChild(el);
	}

	const resultListDate = {
		total: dataSalonWorkingTime.total,
		dataDates,
	};

}
async function loadModalTechnician(service_selected) {
	let formattedDate = formatDateMonth(guest.datetime);
	$("#monthSelected").text(formattedDate);

	await gerenateListDays();

	let dataTechnician = await getSalonWorkingTechnicianByTime(salon_id, service_selected.id, token, guest.datetime);
	let technicians = [];
	if (!dataTechnician.error) {
		//Get Template
		if (dataTechnician.data.length > 0) {
			technicians = dataTechnician.data
	
			$(".add-technician-title").text(
				technicians[0].name
			);
		}
	}

	$("#list-technician").html("");
	for (let index = 0; index < technicians.length; index++) {
		const element = technicians[index];
		var template =
			'<div class="form-check text-start mb-2">' +
			'<input class="form-check-input" type="radio" ';
		if (index === 0) {
			template += "checked ";
		}
		template +=
			'name="technician_selected" value="' +
			element.name +
			'" id="' +
			element.id +
			'">' +
			'<label class="form-check-label mulish-bold fsize-2 p-color" for="' +
			element.id +
			'">' +
			element.name +
			"</label>" +
			"</div>";
		$("#list-technician").append(template);
	}
	$('#list-technician input[name="technician_selected"]').on(
		"change",
		function() {
			$("#addTechnician .add-technician-title").text($(this).val());
		}
	);
}

$(document).ready(function() {
	$("#add-guest-form").submit(function() {
		let data = {};
		$.each($(this).serializeArray(), function(i, field) {
			data[field.name] = field.value;
		});

		if (!isAllowChangeTime) {
			data.datetime = dataPost.guest[0].datetime;
			data.date = dataPost.guest[0].date;
		} else {
			data.datetime = $('input[name="date"]').datepicker("getDate");
			data.datetime.setHours(new Date().getHours());
			data.datetime.setMinutes(new Date().getMinutes());
		}

		$('input[name="monthpicker"]').datepicker({
			format: "mm/yyyy",
			startView: 1,
			minViewMode: 1,
			orientation: "bottom auto",
			autoclose: true,
			startDate: data.datetime,
		});

		guest = data;

		$("#addGuest").modal("hide");
		openAddService();
		return false;
	});

	$("#add-service-form").submit(function() {
		if ($(this).serializeArray().length > 0) {
			let service_selected = $(this).serializeArray()[0].value;
			if (!guest.service_selected) guest.service_selected = [];
			guest.service_selected.push(JSON.parse(service_selected));
			$("#addService").modal("hide");
			openAddTechnician(JSON.parse(service_selected));
		}

		return false;
	});

	$("#add-technician-form").submit(function() {
		if ($(this).serializeArray().length > 0) {
			let technical_selected = $(this).serializeArray();
			technical_selected.push({
				name: "date",
				value: guest.datetime
			});
      technical_selected.push({
				name: "id",
				value: $("input[name='technician_selected']:checked").attr('id')
			});
      
			guest.date = guest.datetime.getMonth() + 1 + "/" + guest.datetime.getDate() + "/" + guest.datetime.getFullYear();

			if (document.querySelector("#timeList .item.active")) {
				const timeSelect = document.querySelector("#timeList .item.active")
					.dataset.value;
				technical_selected.push({
					name: "time",
					value: timeSelect
				});

				guest.service_selected[0].technical_selected = technical_selected;

				if (guestIndex === undefined) dataPost.guest.push(guest);
				else {
					dataPost.guest[guestIndex].service_selected.push(
						guest.service_selected[0]
					);
				}
				$("#addTechnician").modal("hide");
				isAllowChangeTime = false;
				openBookingDetail();
			}
		}
		return false;
	});

	function generateRandomString() {
		const firstPart = Math.floor(Math.random() * 1000000).toString().padStart(6, '0');
		const secondPart = Math.floor(Math.random() * 100000).toString().padStart(5, '0');
		const thirdPart = Math.floor(Math.random() * 10000).toString().padStart(4, '0');
		return `${firstPart}-${secondPart}-${thirdPart}`;
	}
	$("#add-booking-detail-form").submit(async function() {
    $("#add-booking-detail-form .form-results").addClass("d-none")
		dataPost.note = $('#add_note').val();
    var tax = dataPost.subtotal * 0.1;
    var cartdetail = [];
    dataPost.guest.forEach(element => {
      var services = [];

      element.service_selected.forEach(service => {
      var technicianId = service.technical_selected.find((item) => item.name === "id").value;
        services.unshift({
          "serviceId": service.id,
          "fromTime": service.fromTime,
          "toTime": service.toTime,
          "price": service.priceService,
          "technicianId": technicianId,
          "service": service.name
        })
      });

      let obj = {
        "name": element.firstname+" "+element.lastname,
        "detailService": services
      }
      cartdetail.unshift(obj);
    });


    let data = {
      "salonid": salon_id,
      "orderno": "",
      "note": dataPost.note,
      "grandtotal": parseFloat(dataPost.subtotal) + parseFloat(tax),
      "status": 0,
      "tax": tax,
      "othercharge": 0,
      "subtotal": dataPost.subtotal,
      "cartdetail": JSON.stringify(cartdetail)
    }
    let dataCreateOrder = await createSalonCart( token, data);

    if(!dataCreateOrder.error && dataCreateOrder.newId){
    // Store the data in local storage
      // if (!localStorage.getItem('order'))
      //   localStorage.setItem('order', JSON.stringify([]));
      // let localStorageOrder = JSON.parse(localStorage.getItem('order'));
      let orderID = dataCreateOrder.newId;
      // let order = {
      //   id: orderID,
      //   salonid: salon_id,
      //   salonname: salon_name,
      //   data: dataPost
      // }
      // localStorageOrder.push(order)
      // localStorage.setItem('order', JSON.stringify(localStorageOrder));
      // Redirect to the new page
      window.location.href = window._rootPath + "/thankyou/?idsalon=" + salon_id + '&orderno=' + orderID;
    }else{
      $("#add-booking-detail-form .form-results").removeClass("d-none");
      $("#add-booking-detail-form .form-results").text(dataCreateOrder.result)
    }
		
		return false;
	});
	$('input[name="date"]').val(
		new Date().getMonth() +
		1 +
		"/" +
		new Date().getDate() +
		"/" +
		new Date().getFullYear()
	);
	$('input[name="date"]').datepicker({
		orientation: "bottom auto",
		format: "m/dd/yyyy",
		startDate: new Date(),
		defaultViewDate: new Date(),
		autoclose: true,
		todayHighlight: true,
	});
	$('input[name="dateBooking"]').datepicker({
		orientation: "bottom center",
		format: "m/dd/yyyy",
		startDate: new Date(),
		defaultViewDate: new Date(),
		todayHighlight: true,
		autoclose: true,
	});
	$('input[name="dateBooking"]').on("changeDate", async function() {
		var selectedDay = $('input[name="dateBooking"]').datepicker("getDate");
		let options = {
			weekday: "long",
			year: "numeric",
			month: "long",
			day: "numeric",
		};
		let formattedDate = selectedDay.toLocaleDateString("en-US", options);
		$("#bookingDetail .date_booking").text(formattedDate);
		dataPost.guest.forEach((ele) => {
			ele.date = selectedDay.getMonth() + 1 + "/" + selectedDay.getDate() + "/" + selectedDay.getFullYear();
			ele.datetime = selectedDay;
			ele.service_selected.forEach((service) => {
				let date = service.technical_selected.find((item) => item.name === "date");
				date.value = selectedDay;
			})

		});
	});
	$('input[name="monthpicker"]').on("changeDate", async function() {
		var selectedDay = $('input[name="monthpicker"]').datepicker("getDate");

		var dateFomated = formatDateMonth(selectedDay);
		$("#monthSelected").text(dateFomated);
		const now = selectedDay;
		const year = now.getFullYear();
		const month = now.getMonth();
		guest.datetime = new Date(year, month, guest.datetime.getDate());

		await gerenateListDays();
		await initSelectDays();
		selectedDate();
	});

	function setNextActive() {
		const slider = document.querySelector("#dateList");
		const items = slider.querySelectorAll("#dateList .item");
		const widthItem = document.querySelector("#dateList .item").offsetWidth;
		// get index of active item
		const activeIndex = $("#dateList .item.active").index();
		// remove active class from all items
		items.forEach((item) => {
			item.classList.remove("active");
			// item.classList.remove('opacity-20');
		});
		// set next item as active
		let nextIndex = activeIndex + 1;
		if (nextIndex > items.length - 1) {
			nextIndex = new Date().getDate() - 1;
			document.getElementById("formDateList").scrollLeft =
				widthItem * nextIndex;
		} else {
			document.getElementById("formDateList").scrollLeft += widthItem;
		}
		items[nextIndex].classList.add("active");

		const newDate = guest.datetime;
		newDate.setDate(items[nextIndex].dataset.num);
		guest.datetime = newDate;

		return false;
	}

	function setPrevActive() {
		const slider = document.querySelector("#dateList");
		const items = slider.querySelectorAll("#dateList .item");
		const widthItem = document.querySelector("#dateList .item").offsetWidth;
		// get index of active item
		const activeIndex = $("#dateList .item.active").index();
		let prevIndex = activeIndex - 1;
		// remove active class from all items
		items.forEach((item) => {
			item.classList.remove("active");
		});

		if (new Date().getDate() - 1 < activeIndex) {
			// set prev item as active
			if (prevIndex < 0) {
				prevIndex = items.length - 1;
				document.getElementById("formDateList").scrollLeft =
					widthItem * items.length;
			} else {
				document.getElementById("formDateList").scrollLeft -= widthItem;
			}
		} else {
			prevIndex = items.length - 1;
			document.getElementById("formDateList").scrollLeft =
				widthItem * items.length;
		}
		items[prevIndex].classList.add("active");
		const newDate = guest.datetime;
		newDate.setDate(items[prevIndex].dataset.num);
		guest.datetime = newDate;
		return false;
	}
	$("#dateNext").on("click", function() {
		if (isAllowChangeTime) setNextActive();
		return false;
	});
	$("#datePrev").on("click", function() {
		if (isAllowChangeTime) setPrevActive();
		return false;
	});
	$("#timeList .item").on("click", function() {
		const slider = document.querySelector("#timeList");
		const items = slider.querySelectorAll("#timeList .item");
		const widthItem = document.querySelector("#timeList .item").offsetWidth;
		// remove active class from all items
		items.forEach((item) => {
			item.classList.remove("active");
		});
		$(this).addClass("active");
		const activeIndex = $("#timeList .item.active").index();
		document.getElementById("formTimeList").scrollLeft =
			widthItem * activeIndex;
		return false;
	});

	$("#timeNext").on("click", function() {
		const slider = document.querySelector("#timeList");
		const items = slider.querySelectorAll("#timeList .item");
		const widthItem = document.querySelector("#timeList .item").offsetWidth;
		// get index of active item
		const activeIndex = $("#timeList .item.active").index();
		// set next item as active
		let nextIndex = activeIndex + 1;
		if (items[nextIndex] !== undefined && !items[nextIndex].classList.contains('disable')) {
			// remove active class from all items
			items.forEach((item) => {
				item.classList.remove("active");
				// item.classList.remove('opacity-20');
			});
			items[nextIndex].classList.add("active");
		}


		if (nextIndex > items.length - 1) {
			// var firstActiveTime = document.querySelector("#timeList .item:not(.disable)")
			// firstActiveTime.classList.add("active"); // Add active first available
			// const widthTimeItem = document.querySelector("#timeList .item").offsetWidth;
			// document.getElementById("formTimeList").scrollLeft = widthTimeItem * firstActiveTime.dataset.index;
		} else {
			document.getElementById("formTimeList").scrollLeft += widthItem;
		}



		return false;
	});
	$("#timePrev").on("click", function() {
		const slider = document.querySelector("#timeList");
		const items = slider.querySelectorAll("#timeList .item");
		const widthItem = document.querySelector("#timeList .item").offsetWidth;
		// get index of active item
		const activeIndex = $("#timeList .item.active").index();
		// set prev item as active
		let prevIndex = activeIndex - 1;

		if (items[prevIndex] !== undefined && !items[prevIndex].classList.contains('disable')) {
			// remove active class from all items
			items.forEach((item) => {
				item.classList.remove("active");
			});
			items[prevIndex].classList.add("active");
		}
		if (prevIndex < 0) {
			prevIndex = items.length - 1;
			document.getElementById("formTimeList").scrollLeft = widthItem * items.length;
		} else {
			document.getElementById("formTimeList").scrollLeft -= widthItem;
		}

		return false;
	});
});