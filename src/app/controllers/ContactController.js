const ContactRepository = require('../repositories/ContactRepository');

class ContactController {
  async index(request, response) {
    const contacts = await ContactRepository.findAll();
    response.json(contacts);
  }

  async show(request, response) {
    const { id } = request.params;
    const contact = await ContactRepository.findById(id);

    if (!contact) {
      return response.status(400).json('Usuário não encontrado');
    }

    response.json(contact);
  }

  async store(request, response) {
    const {
      name, email, phone, category_id,
    } = request.body;

    if (!name) {
      return response.status(400).json({ error: 'Name is required' });
    }

    const contactExists = await ContactRepository.findByEmail(email);

    if (contactExists.length > 0) {
      return response.status(400).json({ error: 'This e-mail is already been in use' });
    }

    const contact = await ContactRepository.create({
      name, email, phone, category_id,
    });
    response.json(contact);
  }

  async update(request, response) {
    const { id } = request.params;
    const {
      name, email, phone, category_id,
    } = request.body;

    if (!name) {
      return response.status(400).json({ error: 'Name is required' });
    }

    const contactByEmail = await ContactRepository.findByEmail(email);

    if (contactByEmail.length > 0 && contactByEmail.id !== id) {
      return response.status(400).json({ error: 'This e-mail is already been in use' });
    }
    const contact = await ContactRepository.update(id, {
      name, email, phone, category_id,
    });

    response.json(contact);
  }

  async delete(request, response) {
    const { id } = request.params;
    const contact = await ContactRepository.findById(id);

    if (!contact) {
      return response.status(400).json('Usuário não encontrado');
    }
    await ContactRepository.delete(id);
    response.sendStatus(204);
  }
}

module.exports = new ContactController();
