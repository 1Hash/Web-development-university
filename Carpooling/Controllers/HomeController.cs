using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Mvc;

namespace CarpoolingEL.Controllers
{
    public class HomeController : Controller
    {

        private CarpoolingELEntities db = new CarpoolingELEntities();

        public ActionResult Index()
        {
            return View();
        }

        public ActionResult Create()
        {
            ViewBag.Message = "Your application description page.";

            return View();
        }

        public ActionResult Login()
        {
            ViewBag.Message = "Pag login.";

            return View();
        }

        public ActionResult Registrar()
        {
            ViewBag.fkTipo = new SelectList(db.TIPO_USUARIO, "idTipoUser", "descTipo");
            return View();
        }

        [HttpPost]
        public ActionResult Registrar([Bind(Include = "idUsu,nomeUsu,emailUsu,rgUsu,endUsu,compUsu,cepUsu,bairroUsu,cidadeUsu,ufUsu,telUsu,celUsu,usuario,senha,fkTipo")] USUARIOS uSUARIOS)
        {
            int c = db.USUARIOS.Where(e => e.emailUsu == uSUARIOS.emailUsu).Count();

            if (c > 0)
            {
                Session["msgemail"] = " O e-mail " + uSUARIOS.emailUsu + " já existe!";
                return RedirectToAction("Registrar");
            }
            else
            {
                if (ModelState.IsValid)
                {
                    db.USUARIOS.Add(uSUARIOS);
                    db.SaveChanges();
                    Session["msgcad"] = "Usuário " + uSUARIOS.usuario + " foi cadastrado com sucesso!";
                    return RedirectToAction("Login");
                }
            }

            ViewBag.fkTipo = new SelectList(db.TIPO_USUARIO, "idTipoUser", "idTipoUser", uSUARIOS.fkTipo);
            return View(uSUARIOS);
        }

        [HttpPost]
        public ActionResult Login(USUARIOS user)
        {

            var q = db.USUARIOS.Where(u => user.usuario == u.usuario && user.senha == u.senha).FirstOrDefault();

            if (q != null)
            {
                Session["UserID"] = q.idUsu.ToString();
                Session["UserNome"] = q.nomeUsu.ToString();
                Session["UserTipo"] = q.fkTipo.ToString();

                if (user.fkTipo.ToString() == "1")
                {
                    return RedirectToAction("../Passageiro");
                }
                else
                {
                    return RedirectToAction("../Motorista");
                }        
            }
            else
            {
                ModelState.AddModelError("", "Usuário ou senha incorreto!");
            }

            return View();
        }

        public ActionResult Sair()
        {
            return View();
        }
    }
}