<?php

namespace App\Test\Controller;

use App\Entity\Formacion;
use App\Repository\FormacionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FormacionControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private FormacionRepository $repository;
    private string $path = '/formacion/';
    private EntityManagerInterface $manager;

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = static::getContainer()->get('doctrine')->getRepository(Formacion::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Formacion index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $originalNumObjectsInRepository = count($this->repository->findAll());

        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'formacion[titulo]' => 'Testing',
            'formacion[duracion]' => 'Testing',
            'formacion[centro]' => 'Testing',
            'formacion[fechadeinicio]' => 'Testing',
            'formacion[fechafin]' => 'Testing',
        ]);

        self::assertResponseRedirects('/formacion/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Formacion();
        $fixture->setTitulo('My Title');
        $fixture->setDuracion('My Title');
        $fixture->setCentro('My Title');
        $fixture->setFechadeinicio('My Title');
        $fixture->setFechafin('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Formacion');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Formacion();
        $fixture->setTitulo('My Title');
        $fixture->setDuracion('My Title');
        $fixture->setCentro('My Title');
        $fixture->setFechadeinicio('My Title');
        $fixture->setFechafin('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'formacion[titulo]' => 'Something New',
            'formacion[duracion]' => 'Something New',
            'formacion[centro]' => 'Something New',
            'formacion[fechadeinicio]' => 'Something New',
            'formacion[fechafin]' => 'Something New',
        ]);

        self::assertResponseRedirects('/formacion/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getTitulo());
        self::assertSame('Something New', $fixture[0]->getDuracion());
        self::assertSame('Something New', $fixture[0]->getCentro());
        self::assertSame('Something New', $fixture[0]->getFechadeinicio());
        self::assertSame('Something New', $fixture[0]->getFechafin());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Formacion();
        $fixture->setTitulo('My Title');
        $fixture->setDuracion('My Title');
        $fixture->setCentro('My Title');
        $fixture->setFechadeinicio('My Title');
        $fixture->setFechafin('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/formacion/');
    }
}
