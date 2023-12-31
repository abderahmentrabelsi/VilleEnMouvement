var direction = "ltr", assetPath = "../../../app-assets/";
"rtl" == $("html").data("textdirection") && (direction = "rtl"), "laravel" === $("body").attr("data-framework") && (assetPath = $("body").attr("data-asset-path")), $(document).on("click", ".fc-sidebarToggle-button", (function (e) {
  $(".app-calendar-sidebar, .body-content-overlay").addClass("show")
})), $(document).on("click", ".body-content-overlay", (function (e) {
  $(".app-calendar-sidebar, .body-content-overlay").removeClass("show")
})), document.addEventListener("DOMContentLoaded", (function () {
  var e, t = document.getElementById("calendar"), a = $(".event-sidebar"),
    n = {Business: "primary", Holiday: "success", Personal: "danger", Family: "warning", ETC: "info"},
    l = $(".event-form"), d = $(".add-event-btn"), r = $(".btn-cancel"), o = $(".update-event-btn"),
    i = $(".btn-toggle-sidebar"), s = $("#title"), c = $("#select-label"), v = $("#start-date"), u = $("#end-date"),
    p = $("#event-url"), f = $("#event-guests"), h = $("#event-location"), m = $(".allDay-switch"),
    g = $(".select-all"), b = $(".calendar-events-filter"), y = $(".input-filter"), k = $(".btn-delete-event"),
    C = $("#event-description-editor");
  if ($(".add-event button").on("click", (function (e) {
    $(".event-sidebar").addClass("show"), $(".sidebar-left").removeClass("show"), $(".app-calendar .body-content-overlay").addClass("show")
  })), c.length) {
    function w(e) {
      return e.id ? "<span class='bullet bullet-" + $(e.element).data("label") + " bullet-sm me-50'> </span>" + e.text : e.text
    }

    c.wrap('<div class="position-relative"></div>').select2({
      placeholder: "Select value",
      dropdownParent: c.parent(),
      templateResult: w,
      templateSelection: w,
      minimumResultsForSearch: -1,
      escapeMarkup: function (e) {
        return e
      }
    })
  }
  if (f.length) {
    function x(e) {
      return e.id ? "<div class='d-flex flex-wrap align-items-center'><div class='avatar avatar-sm my-0 me-50'><span class='avatar-content'><img src='" + assetPath + "images/avatars/" + $(e.element).data("avatar") + "' alt='avatar' /></span></div>" + e.text + "</div>" : e.text
    }

    f.wrap('<div class="position-relative"></div>').select2({
      placeholder: "Select value",
      dropdownParent: f.parent(),
      closeOnSelect: !1,
      templateResult: x,
      templateSelection: x,
      escapeMarkup: function (e) {
        return e
      }
    })
  }
  if (v.length) var D = v.flatpickr({
    enableTime: !0, altFormat: "Y-m-dTH:i:S", onReady: function (e, t, a) {
      a.isMobile && $(a.mobileInput).attr("step", null)
    }
  });
  if (u.length) var P = u.flatpickr({
    enableTime: !0, altFormat: "Y-m-dTH:i:S", onReady: function (e, t, a) {
      a.isMobile && $(a.mobileInput).attr("step", null)
    }
  });

  function S() {
    $(".fc-sidebarToggle-button").empty().append(feather.icons.menu.toSvg({class: "ficon"}))
  }

  var E = new FullCalendar.Calendar(t, {
    initialView: "dayGridMonth",
    events: function (e, t) {
      var a, n = (a = [], $(".calendar-events-filter input:checked").each((function () {
        a.push($(this).attr("data-value"))
      })), a);
      selectedEvents = events.filter((function (e) {
        return n.includes(e.extendedProps.calendar.toLowerCase())
      })), t(selectedEvents)
    },
    editable: !0,
    dragScroll: !0,
    dayMaxEvents: 2,
    eventResizableFromStart: !0,
    customButtons: {sidebarToggle: {text: "Sidebar"}},
    headerToolbar: {start: "sidebarToggle, prev,next, title", end: "dayGridMonth,timeGridWeek,timeGridDay,listMonth"},
    direction: direction,
    initialDate: new Date,
    navLinks: !0,
    eventClassNames: function ({event: e}) {
      return ["bg-light-" + n[e._def.extendedProps.calendar]]
    },
    dateClick: function (e) {
      var t = moment(e.date).format("YYYY-MM-DD");
      T(), a.modal("show"), d.removeClass("d-none"), o.addClass("d-none"), k.addClass("d-none"), v.val(t), u.val(t)
    },
    eventClick: function (t) {
      !function (t) {
        (e = t.event).url && (t.jsEvent.preventDefault(), window.open(e.url, "_blank")), a.modal("show"), d.addClass("d-none"), r.addClass("d-none"), o.removeClass("d-none"), k.removeClass("d-none"), s.val(e.title), D.setDate(e.start, !0, "Y-m-d"), !0 === e.allDay ? m.prop("checked", !0) : m.prop("checked", !1), null !== e.end ? P.setDate(e.end, !0, "Y-m-d") : P.setDate(e.start, !0, "Y-m-d"), a.find(c).val(e.extendedProps.calendar).trigger("change"), void 0 !== e.extendedProps.location && h.val(e.extendedProps.location), void 0 !== e.extendedProps.guests && f.val(e.extendedProps.guests).trigger("change"), void 0 !== e.extendedProps.guests && C.val(e.extendedProps.description), k.on("click", (function () {
          e.remove(), a.modal("hide"), $(".event-sidebar").removeClass("show"), $(".app-calendar .body-content-overlay").removeClass("show")
        }))
      }(t)
    },
    datesSet: function () {
      S()
    },
    viewDidMount: function () {
      S()
    }
  });
  E.render(), S(), l.length && l.validate({
    submitHandler: function (e, t) {
      t.preventDefault(), l.valid() && a.modal("hide")
    },
    title: {required: !0},
    rules: {"start-date": {required: !0}, "end-date": {required: !0}},
    messages: {"start-date": {required: "Start Date is required"}, "end-date": {required: "End Date is required"}}
  }), i.length && i.on("click", (function () {
    r.removeClass("d-none")
  }));
  const M = (e, t, a) => {
    const n = E.getEventById(e.id);
    for (var l = 0; l < t.length; l++) {
      var d = t[l];
      n.setProp(d, e[d])
    }
    n.setDates(e.start, e.end, {allDay: e.allDay});
    for (l = 0; l < a.length; l++) {
      d = a[l];
      n.setExtendedProp(d, e.extendedProps[d])
    }
  };

  function T() {
    u.val(""), p.val(""), v.val(""), s.val(""), h.val(""), m.prop("checked", !1), f.val("").trigger("change"), C.val("")
  }

  $(d).on("click", (function () {
    if (l.valid()) {
      var e = {
        id: E.getEvents().length + 1,
        title: s.val(),
        start: v.val(),
        end: u.val(),
        startStr: v.val(),
        endStr: u.val(),
        display: "block",
        extendedProps: {location: h.val(), guests: f.val(), calendar: c.val(), description: C.val()}
      };
      p.val().length && (e.url = p.val()), m.prop("checked") && (e.allDay = !0), t = e, E.addEvent(t), E.refetchEvents()
    }
    var t
  })), o.on("click", (function () {
    l.valid() && (!function (e) {
      M(e, ["id", "title", "url"], ["calendar", "guests", "location", "description"])
    }({
      id: e.id,
      title: a.find(s).val(),
      start: a.find(v).val(),
      end: a.find(u).val(),
      url: p.val(),
      extendedProps: {location: h.val(), guests: f.val(), calendar: c.val(), description: C.val()},
      display: "block",
      allDay: !!m.prop("checked")
    }), a.modal("hide"))
  })), a.on("hidden.bs.modal", (function () {
    T()
  })), $(".btn-toggle-sidebar").on("click", (function () {
    k.addClass("d-none"), o.addClass("d-none"), d.removeClass("d-none"), $(".app-calendar-sidebar, .body-content-overlay").removeClass("show")
  })), g.length && g.on("change", (function () {
    $(this).prop("checked") ? b.find("input").prop("checked", !0) : b.find("input").prop("checked", !1), E.refetchEvents()
  })), y.length && y.on("change", (function () {
    $(".input-filter:checked").length < b.find("input").length ? g.prop("checked", !1) : g.prop("checked", !0), E.refetchEvents()
  }))
}));
