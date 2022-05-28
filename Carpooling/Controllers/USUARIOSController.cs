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
    public class USUARIOSController : Controller
    {
        private CarpoolingELEntities db = new CarpoolingELEntities();

        // GET: USUARIOS
        public ActionResult Index()
        {
            var uSUARIOS = db.USUARIOS.Include(u => u.TIPO_USUARIO);
            return View(uSUARIOS.ToList());
        }

        // GET: USUARIOS/Details/5
        public ActionResult Details(int? id)
        {
            if (id == null)
            {
                return new HttpStatusCodeResult(HttpStatusCode.BadRequest);
            }
            USUARIOS uSUARIOS = db.USUARIOS.Find(id);
            if (uSUARIOS == null)
            {
                return HttpNotFound();
            }
            return View(uSUARIOS);
        }

        // GET: USUARIOS/Create
        public ActionResult Registrar2()
        {
            ViewBag.fkTipo = new SelectList(db.TIPO_USUARIO, "idTipoUser", "idTipoUser");
            return View();
        }

        // POST: USUARIOS/Create
        [HttpPost]
        [ValidateAntiForgeryToken]
        public ActionResult Registrar2([Bind(Include = "idUsu,nomeUsu,emailUsu,rgUsu,endUsu,compUsu,cepUsu,bairroUsu,cidadeUsu,ufUsu,telUsu,celUsu,usuario,senha,fkTipo")] USUARIOS uSUARIOS)
        {
            if (ModelState.IsValid)
            {
                db.USUARIOS.Add(uSUARIOS);
                db.SaveChanges();
                return RedirectToAction("Index");
            }

            ViewBag.fkTipo = new SelectList(db.TIPO_USUARIO, "idTipoUser", "idTipoUser", uSUARIOS.fkTipo);
            return View(uSUARIOS);
        }

        // GET: USUARIOS/Edit/5
        public ActionResult Edit(int? id)
        {
            if (id == null)
            {
                return new HttpStatusCodeResult(HttpStatusCode.BadRequest);
            }
            USUARIOS uSUARIOS = db.USUARIOS.Find(id);
            if (uSUARIOS == null)
            {
                return HttpNotFound();
            }
            ViewBag.fkTipo = new SelectList(db.TIPO_USUARIO, "idTipoUser", "idTipoUser", uSUARIOS.fkTipo);
            return View(uSUARIOS);
        }

        // POST: USUARIOS/Edit/5
        // Para se proteger de mais ataques, ative as propriedades específicas a que você quer se conectar. Para 
        // obter mais detalhes, consulte https://go.microsoft.com/fwlink/?LinkId=317598.
        [HttpPost]
        [ValidateAntiForgeryToken]
        public ActionResult Edit([Bind(Include = "idUsu,nomeUsu,emailUsu,rgUsu,endUsu,compUsu,cepUsu,bairroUsu,cidadeUsu,ufUsu,telUsu,celUsu,usuario,senha,fkTipo")] USUARIOS uSUARIOS)
        {
            if (ModelState.IsValid)
            {
                db.Entry(uSUARIOS).State = EntityState.Modified;
                db.SaveChanges();
                return RedirectToAction("Index");
            }
            ViewBag.fkTipo = new SelectList(db.TIPO_USUARIO, "idTipoUser", "idTipoUser", uSUARIOS.fkTipo);
            return View(uSUARIOS);
        }

        // GET: USUARIOS/Delete/5
        public ActionResult Delete(int? id)
        {
            if (id == null)
            {
                return new HttpStatusCodeResult(HttpStatusCode.BadRequest);
            }
            USUARIOS uSUARIOS = db.USUARIOS.Find(id);
            if (uSUARIOS == null)
            {
                return HttpNotFound();
            }
            return View(uSUARIOS);
        }

        // POST: USUARIOS/Delete/5
        [HttpPost, ActionName("Delete")]
        [ValidateAntiForgeryToken]
        public ActionResult DeleteConfirmed(int id)
        {
            USUARIOS uSUARIOS = db.USUARIOS.Find(id);
            db.USUARIOS.Remove(uSUARIOS);
            db.SaveChanges();
            return RedirectToAction("Index");
        }

        protected override void Dispose(bool disposing)
        {
            if (disposing)
            {
                db.Dispose();
            }
            base.Dispose(disposing);
        }
    }
}
