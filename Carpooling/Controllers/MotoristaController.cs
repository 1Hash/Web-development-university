using System;
using System.Collections.Generic;
using System.Data;
using System.Data.Entity;
using System.Linq;
using System.Net;
using System.Web;
using System.Web.Mvc;
using CarpoolingEL;

namespace CarpoolingEL.Controllers
{
    public class MotoristaController : Controller
    {
        private CarpoolingELEntities db = new CarpoolingELEntities();

        // GET: Motorista
        public ActionResult Index()
        {
            int v = Convert.ToInt32(Session["UserID"]);
            var aGENDA_USUARIOS = db.AGENDA_USUARIOS.Include(a => a.AGENDA).Include(a => a.USUARIOS).Where(a => a.AGENDA.fkUsu == v);
            return View(aGENDA_USUARIOS.ToList());
        }

        public ActionResult Configuracoes()
        {
            int v = Convert.ToInt32(Session["UserID"]);
            USUARIOS uSUARIOS = db.USUARIOS.Find(v);
            return View(uSUARIOS);
        }

        public ActionResult Sair(int? id)
        {
            AGENDA_USUARIOS aGENDA_USUARIOS = db.AGENDA_USUARIOS.Find(id);
            db.AGENDA_USUARIOS.Remove(aGENDA_USUARIOS);
            db.SaveChanges();
            return RedirectToAction("Index");
        }

        public ActionResult Editar()
        {

            int v = Convert.ToInt32(Session["UserID"]);

            USUARIOS uSUARIOS = db.USUARIOS.Find(v);
            if (uSUARIOS == null)
            {
                return HttpNotFound();
            }
            ViewBag.fkTipo = new SelectList(db.TIPO_USUARIO, "idTipoUser", "idTipoUser", uSUARIOS.fkTipo);
            return View(uSUARIOS);
        }

        [HttpPost]
        public ActionResult Editar([Bind(Include = "idUsu,nomeUsu,emailUsu,rgUsu,endUsu,compUsu,cepUsu,bairroUsu,cidadeUsu,ufUsu,telUsu,celUsu,usuario,senha,fkTipo")] USUARIOS uSUARIOS)
        {
            if (ModelState.IsValid)
            {
                db.Entry(uSUARIOS).State = EntityState.Modified;
                db.SaveChanges();
                Session["msgedit"] = "Seus dados foram alterados com sucesso!";
                return RedirectToAction("Configuracoes");
            }
            ViewBag.fkTipo = new SelectList(db.TIPO_USUARIO, "idTipoUser", "idTipoUser", uSUARIOS.fkTipo);
            return View(uSUARIOS);
        }
    }
}