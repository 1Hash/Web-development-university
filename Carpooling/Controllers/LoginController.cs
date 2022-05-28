using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Mvc;

namespace CarpoolingEL.Controllers
{

    [Authorize]
    public class LoginController : Controller {

        [AllowAnonymous]
        public ActionResult Login(string returnUrl) {

            ViewBag.ReturnUrl = returnUrl;

            return View();
        }
    }
}



